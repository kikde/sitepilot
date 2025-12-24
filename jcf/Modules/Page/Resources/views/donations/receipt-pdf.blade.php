<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Receipt {{ $donation->receipt_no }}</title>
  <style>
    body{ font-family: DejaVu Sans, Arial, Helvetica, sans-serif; color:#111; }
    .wrap{ padding:24px; }
    .hdr{ display:flex; align-items:center; justify-content:space-between; border-bottom:2px solid #eee; padding-bottom:12px; margin-bottom:16px;}
    .logo{ height:90px;}
    h1{ margin:0; font-size:20px;}
    h2{ margin:0; font-size:15px;}
    table.meta{ width:100%; border-collapse:collapse; margin:12px 0;}
    table.meta td{ padding:6px 8px; border:1px solid #e7e7e7; }
    .muted{ color:#666; font-size:12px; }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="hdr">
         @if(!empty($setting?->site_logo))
        <img class="logo" src="{{ public_path('backend/uploads/'.$setting->site_logo) }}" alt="logo">
        @endif
      <div>
        <div class="muted">80G Eligible Donation Receipt</div>
        <h1>{{ $setting->title ?? config('app.name') }}</h1>
        <!--<h2>{{ $setting->title ?? 'NO TITLE' }}</h2>-->
        <h2>Address: {{ $setting->address ?? 'NO ADDRESS' }}</h2>
        <h2>Regd. No: {{ $setting->company_no ?? 'NO COMPANY NO' }}</h2>
        <h2>PAN: {{ $setting->pan_no ?? 'NO PAN' }}</h2>
        
      </div>
     
    </div>

    <table class="meta">
      <tr><td><b>Receipt No</b></td><td>{{ $donation->receipt_no }}</td></tr>
      <tr><td><b>Date</b></td><td>{{ $date }}</td></tr>
      <tr><td><b>Donor</b></td><td>{{ $donor->name }} @if($donor->pan_no) (PAN: {{ $donor->pan_no }}) @endif</td></tr>
      <tr><td><b>Address</b></td><td>{{ trim($donor->address.' '.$donor->city.' '.$donor->state.' '.$donor->pincode) }}</td></tr>
      <tr><td><b>Amount</b></td><td>₹ {{ number_format($amount, 2) }} (INR)</td></tr>
      <tr><td><b>Campaign</b></td><td>{{ $donation->campaign ?? 'General Donation' }}</td></tr>
      <tr><td><b>Payment ID</b></td><td>{{ $donation->razorpay_payment_id }}</td></tr>
      <tr><td><b>Order ID</b></td><td>{{ $donation->razorpay_order_id }}</td></tr>
    </table>

    <p class="muted">
      This receipt is issued for voluntary donation received. No goods or services were provided in whole or partial
      consideration for this contribution. Please retain this receipt for your records.
    </p>
    <p class="muted">This is a computer-generated document and does not require a physical signature.</p>
  </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Donation Receipt</title>
  <style>
    body{ font-family: DejaVu Sans, sans-serif; font-size: 12px; color:#0f172a; }
    .wrap{ padding:24px; }
    .head{ display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; }
    .title{ font-size:18px; font-weight:700; }
    .muted{ color:#6b7280; }
    .box{ border:1px solid #e5e7eb; border-radius:8px; padding:12px; margin-bottom:12px; }
    .row{ display:flex; justify-content:space-between; gap:12px; }
    .label{ color:#64748b; }
    .val{ font-weight:700; }
    .mt{ margin-top:8px; }
  </style>
  </head>
  <body>
    <div class="wrap">
      <div class="head">
        <div>
          <div class="title">Donation Receipt</div>
          <div class="muted">{{ $setting->site_title ?? config('app.name') }}</div>
        </div>
        <div class="muted">Date: {{ $date ?? now()->format('d M Y') }}</div>
      </div>

      <div class="box">
        <div class="row"><div class="label">Receipt No.</div><div class="val">{{ $donation->receipt_no }}</div></div>
        <div class="row mt"><div class="label">Donor</div><div class="val">{{ $donor->name }} ({{ $donor->mobile }})</div></div>
        @if(!empty($donor->pan_no))
          <div class="row mt"><div class="label">PAN</div><div class="val">{{ $donor->pan_no }}</div></div>
        @endif
        <div class="row mt"><div class="label">Campaign</div><div class="val">{{ $donation->campaign ?? '-' }}</div></div>
        <div class="row mt"><div class="label">Amount</div><div class="val">INR {{ number_format($amount, 2) }}</div></div>
        <div class="row mt"><div class="label">Status</div><div class="val">{{ ucfirst($donation->status) }}</div></div>
      </div>

      <div class="muted">This is a computer generated receipt.</div>
    </div>
  </body>
  </html>
