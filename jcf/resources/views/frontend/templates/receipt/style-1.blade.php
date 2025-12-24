<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Payment Receipt</title>
  <meta name="bps" content="delhi91">

  <style>
    /* ===== page & layout ===== */
    :root{
      --page-size: A4;
      --page-width: 210mm;
      --page-height: 297mm;
      --page-margin: 10mm;
    }
    @page { size: var(--page-size); margin: var(--page-margin); }
    html,body { margin:0; padding:0; background:#fff; }
    body { width: var(--page-width); min-height: var(--page-height); }

    .sheet{
      position: relative;
      width: 100%;
      min-height: calc(var(--page-height) - 2 * var(--page-margin));
      display: flex;
      align-items: flex-start;
      justify-content: center;
    }

    /* receipt canvas; original artwork = 1599x947 */
    .receipt{
      position: relative;
      aspect-ratio: 1599 / 947;
      width: 100%;
      max-width: calc(var(--page-width) - 2 * var(--page-margin));
      background-repeat: no-repeat;
      background-size: 100% 100%;
      background-position: center;
      overflow: hidden;

      /* base responsive font size:
         scales with page width but capped for safety */
      font-size: clamp(10px, 1.7vw, 20px);
      font-family: Arial, Helvetica, sans-serif;
      color: #000;
    }

    /* absolute helpers using percents (relative to artwork size) */
    .abs{ position:absolute; left:var(--x); top:var(--y); width:var(--w,auto); height:var(--h,auto); }

    /* typographic scales (multipliers of base) */
    .t-37 { font-size: 2.1em;  font-weight: 700; } /* ~37px @ base 18px */
    .t-35 { font-size: 1.95em; font-weight: 700; }
    .t-43 { font-size: 2.4em;  font-weight: 700; }
    .t-64 { font-size: 3.5em;  font-weight: 700; }

    .center { text-align: center; }
  </style>
</head>

<body>
  @if($payrec)
  @php
    // $payrec appears to be the User from your controller.
    // If you later pass a Payment model too, you can read real amount/mode from it.
    $amountNumber = 1100; // fallback, replace with $payment->amount ?? 1100
    $amountText   = 'One Thousand One Hundred Rupee'; // replace with Str::ucfirst(numfmt_format(...)) if needed
    $mode         = 'UPI'; // replace with $payment->mode ?? 'UPI'
    $createdAt    = optional($payrec->created_at)->format('d/m/Y');
    $receiptId    = $payrec->id; // or $payment->id if you use Payment model id
  @endphp

  <div class="sheet">
    <div class="receipt" style="background-image:url('{{ asset('frontend/custom/card/bps-receipt.png') }}');">

      <!-- Name (left:608, top:311, width:940 on 1599x947) -->
      <div class="abs" style="--x:38%; --y:32.8%; --w:58.8%;">
        <span class="t-43">{{ $payrec->name }}</span>
      </div>

      <!-- Amount in words (left:474, top:420, width:1074) -->
      <div class="abs" style="--x:29.6%; --y:44.3%; --w:67.2%;">
        <span class="t-37">{{ $amountText }}</span>
      </div>

      <!-- Date (left:480, top:533, width:190) -->
      <div class="abs" style="--x:30%; --y:56.3%;">
        <span class="t-35">{{ $createdAt }}</span>
      </div>

      <!-- Mode (left:217, top:533, width:241) -->
      <div class="abs center" style="--x:13.6%; --y:56.3%; --w:15.1%;">
        <span class="t-35">{{ $mode }}</span>
      </div>

      <!-- Big numeric amount (left:289, top:781, width:223) -->
      <div class="abs" style="--x:18.1%; --y:82.4%;">
        <span class="t-64">{{ number_format($amountNumber) }}/-</span>
      </div>

      <!-- Receipt/Ref ID (left:300, top:194, width:190) -->
      <div class="abs" style="--x:18.8%; --y:20.5%;">
        <span class="t-37">{{ $receiptId }}</span>
      </div>

    </div>
  </div>

  @else
  <div style="padding:24px;font:16px/1.4 Arial, sans-serif;">No Data Found</div>
  @endif
</body>
</html>
