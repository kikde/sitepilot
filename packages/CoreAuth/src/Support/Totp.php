<?php

namespace Dapunjabi\CoreAuth\Support;

class Totp
{
    public static function generateSecret(int $length = 16): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = '';
        for ($i = 0; $i < $length; $i++) {
            $secret .= $alphabet[random_int(0, strlen($alphabet) - 1)];
        }
        return $secret;
    }

    public static function verify(string $secret, string $code, int $window = 1, int $period = 30, int $digits = 6): bool
    {
        $code = trim($code);
        if (!ctype_digit($code)) return false;
        $ts = floor(time() / $period);
        for ($i = -$window; $i <= $window; $i++) {
            if (hash_equals(self::totp($secret, $ts + $i, $digits), str_pad($code, $digits, '0', STR_PAD_LEFT))) {
                return true;
            }
        }
        return false;
    }

    public static function totp(string $secret, int $timeSlice, int $digits = 6): string
    {
        $key = self::base32Decode($secret);
        $time = pack('N*', 0) . pack('N*', $timeSlice);
        $hash = hash_hmac('sha1', $time, $key, true);
        $offset = ord($hash[19]) & 0xf;
        $binCode = ((ord($hash[$offset]) & 0x7f) << 24) |
                   ((ord($hash[$offset + 1]) & 0xff) << 16) |
                   ((ord($hash[$offset + 2]) & 0xff) << 8) |
                   (ord($hash[$offset + 3]) & 0xff);
        $otp = $binCode % (10 ** $digits);
        return str_pad((string)$otp, $digits, '0', STR_PAD_LEFT);
    }

    public static function otpauthUrl(string $issuer, string $labelEmail, string $secret): string
    {
        $issuerEnc = rawurlencode($issuer);
        $label = rawurlencode($issuer.':'.$labelEmail);
        return "otpauth://totp/{$label}?secret={$secret}&issuer={$issuerEnc}&algorithm=SHA1&digits=6&period=30";
    }

    public static function base32Decode(string $b32): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $b32 = strtoupper($b32);
        $buffer = 0; $bitsLeft = 0; $result = '';
        for ($i = 0; $i < strlen($b32); $i++) {
            $val = strpos($alphabet, $b32[$i]);
            if ($val === false) continue;
            $buffer = ($buffer << 5) | $val;
            $bitsLeft += 5;
            if ($bitsLeft >= 8) {
                $bitsLeft -= 8;
                $result .= chr(($buffer >> $bitsLeft) & 0xFF);
            }
        }
        return $result;
    }
}

