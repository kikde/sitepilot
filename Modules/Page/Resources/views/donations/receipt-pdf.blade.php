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
