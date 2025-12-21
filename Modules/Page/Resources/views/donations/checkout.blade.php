@extends('layouts.master')

@section('content')
<div class="auto-container py-5 text-center">
  <h3>Processing your donation…</h3>
  <p>Please wait while we open the secure payment window.</p>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
(function(){
  var options = {
    key: "{{ $key }}",
    amount: "{{ $amountPaise }}",
    currency: "INR",
    name: "{{ $setting->title ?? 'Donation' }}",
    description: "Donation",
    order_id: "{{ $orderId }}",
    prefill: {
      name: "{{ $donor->name }}",
      email: "{{ $donor->email }}",
      contact: "{{ $donor->mobile }}"
    },
    theme: { color: "#ff4747" },
    handler: function (response){
      // POST success to server for signature verification
      var form = document.createElement('form');
      form.method = 'POST';
      form.action = "{{ $callbackRoute }}";
      var _token  = document.createElement('input');
      _token.name = '_token'; _token.value = "{{ csrf_token() }}"; _token.type='hidden';
      var pid = document.createElement('input');
      pid.name = 'razorpay_payment_id'; pid.value = response.razorpay_payment_id; pid.type='hidden';
      var oid = document.createElement('input');
      oid.name = 'razorpay_order_id'; oid.value = response.razorpay_order_id; oid.type='hidden';
      var sig = document.createElement('input');
      sig.name = 'razorpay_signature'; sig.value = response.razorpay_signature; sig.type='hidden';
      form.appendChild(_token); form.appendChild(pid); form.appendChild(oid); form.appendChild(sig);
      document.body.appendChild(form); form.submit();
    },
    modal: {
      ondismiss: function(){
        window.location = "{{ url('/donation-cancelled') }}";
      }
    }
  };

  var rzp = new Razorpay(options);
  rzp.open();
})();
</script>
@endsection
