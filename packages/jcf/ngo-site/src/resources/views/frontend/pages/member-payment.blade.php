@extends('layouts.master')

@section('content')
@if(session('success') || session('error') || session('message'))
  <div style="max-width:960px;margin:16px auto 0;padding:12px 16px;border-radius:8px;{{ session('error') ? 'background:#ffe6e6;color:#a30000;border:1px solid #ffb3b3;' : 'background:#e8fff0;color:#085c2e;border:1px solid #b9f0cd;' }}">
    {!! session('success') ?? session('message') ?? session('error') !!}
  </div>
@endif

<section class="member-register" style="min-height:70vh;display:flex;justify-content:center;align-items:center;">
  <div class="mr-card" style="max-width:520px;box-shadow:0 10px 26px rgba(0,0,0,.08);border:1px solid #e5e7eb;border-radius:18px;overflow:hidden;">
    <div class="mr-head" style="display:flex;align-items:center;gap:10px;padding:14px 18px;color:#fff;background:linear-gradient(135deg,#ff4d4d,#ff944d);">
      <i class="fa-solid fa-credit-card"></i>
      <h2 style="margin:0;font-size:18px;font-weight:700;">Pay Membership Fee</h2>
    </div>
    <div class="mr-body" style="padding:18px;">
      <p style="margin-bottom:12px;">
        Hi <strong>{{ $user->name }}</strong>, please complete your membership payment.
      </p>
      <p style="font-size:15px;margin-bottom:24px;">
        Amount payable: <strong>&#8377; {{ number_format($amount, 2) }}</strong>
      </p>

      <button id="rzp-button" class="btn btn-primary" style="width:100%;appearance:none;border:0;border-radius:10px;padding:10px 14px;background:linear-gradient(135deg,#ff4d4d,#ff944d);color:#fff;font-weight:700;">Pay with Razorpay</button>

      <form name="razorpayform" id="razorpayform" action="{{ route('payment.callback') }}" method="POST">
        @csrf
        <input type="hidden" name="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id">
        <input type="hidden" name="razorpay_signature">
      </form>
    </div>
  </div>
</section>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  (function(){
    var options = {
      key: "{{ $key }}",
      amount: "{{ $order['amount'] }}",
      currency: "{{ $order['currency'] }}",
      name: "{{ $setting->title ?? 'Membership' }}",
      description: "Membership Fee",
      order_id: "{{ $order['id'] }}",
      prefill: {
        name: "{{ $user->name }}",
        email: "{{ $user->email }}",
        contact: "{{ $user->mobile }}"
      },
      theme: { color: "#ff4d4d" },
      handler: function (response){
        var form = document.getElementById('razorpayform');
        form.razorpay_payment_id.value = response.razorpay_payment_id || '';
        form.razorpay_order_id.value   = response.razorpay_order_id || '';
        form.razorpay_signature.value  = response.razorpay_signature || '';
        form.submit();
      }
    };
    var rzp1 = new Razorpay(options);
    var btn = document.getElementById('rzp-button');
    if (btn) btn.onclick = function(e){ rzp1.open(); e.preventDefault(); };
  })();
</script>
@endsection

