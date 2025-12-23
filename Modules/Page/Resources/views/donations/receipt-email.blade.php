<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Donation Receipt</title>
    <style>
      body{font-family: Arial, Helvetica, sans-serif; color:#111;}
      .wrap{max-width:640px;margin:0 auto;padding:12px 8px;}
      .h1{font-size:18px;margin:0 0 6px;}
      .muted{color:#555;}
      .kv{margin:6px 0;}
      .kv b{display:inline-block;width:140px;}
    </style>
  </head>
  <body>
    <div class="wrap">
      <p class="h1">Thank you, {{ ($donor->name ?? optional($donation->donor)->name ?? 'Donor') }}!</p>
      <p>We've received your donation. Please find your 80G receipt attached.</p>

      <div class="kv"><b>Receipt No:</b> {{ $donation->receipt_no }}</div>
      <div class="kv"><b>Amount:</b> &#8377; {{ number_format(($amount ?? ((float)($donation->amount_paise ?? 0)/100)), 2) }}</div>
      <div class="kv"><b>Date:</b> {{ optional($donation->updated_at ?? now())->format('d M Y') }}</div>
      <div class="kv"><b>Payment ID:</b> {{ $donation->razorpay_payment_id }}</div>

      <p class="muted">If you need any help, reply to this email.</p>
      <p>Thanks & regards,<br><b>{{ $setting->title ?? config('app.name') }}</b></p>
    </div>
  </body>
</html>