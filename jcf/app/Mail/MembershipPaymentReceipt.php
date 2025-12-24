<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\User\Entities\Payment;
use Modules\User\Entities\User;

class MembershipPaymentReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public Payment $payment,
        public ?string $attachmentPathPublic = null // relative to storage/app/public
    ) {}

    public function build()
    {
        $amount = $this->payment->amount ? round($this->payment->amount / 100, 2) : null;

        $body = '<p>Dear '.e($this->user->name).',</p>'
              . '<p>Thank you for your membership payment. Your payment details are below and a PDF receipt is attached.</p>'
              . '<table>'
              . '<tr><th align="left">Payment ID</th><td>'.e($this->payment->razorpay_payment_id ?? '—').'</td></tr>'
              . '<tr><th align="left">Order ID</th><td>'.e($this->payment->razorpay_order_id ?? '—').'</td></tr>'
              . '<tr><th align="left">Status</th><td>'.e($this->payment->status ?? 'captured').'</td></tr>'
              . '<tr><th align="left">Amount</th><td>'.($amount !== null ? 'INR '.number_format($amount, 2) : '—').'</td></tr>'
              . '<tr><th align="left">Date</th><td>'.now()->format('d-m-Y H:i').'</td></tr>'
              . '</table>'
              . '<p>We will verify your payment and activate your membership shortly.</p>';

        $mail = $this
            ->from(get_static_option('site_global_email'), get_static_option('site_'.get_default_language().'_title'))
            ->subject('Membership Payment Receipt')
            ->view('mail.basic-mail-template', ['data' => ['message' => $body, 'subject' => 'Membership Payment Receipt']]);

        if ($this->attachmentPathPublic) {
            $absolute = storage_path('app/public/' . ltrim($this->attachmentPathPublic, '/'));
            if (is_file($absolute)) {
                $mail->attach($absolute, [
                    'as' => 'membership-receipt.pdf',
                    'mime' => 'application/pdf',
                ]);
            }
        }

        return $mail;
    }
}

