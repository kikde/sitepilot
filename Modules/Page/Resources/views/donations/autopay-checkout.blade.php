@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="mb-3">Setup UPI Autopay Donation</h2>
    <p>Hello <strong>{{ $donor->name }}</strong>, click the button below to approve recurring donation via UPI Autopay.</p>

    <form id="autopay-form" action="{{ $callbackRoute }}" method="POST">
        @csrf
        <input type="hidden" name="razorpay_payment_id"      id="rzp_payment_id">
        <input type="hidden" name="razorpay_subscription_id" id="rzp_subscription_id">
        <input type="hidden" name="razorpay_signature"       id="rzp_signature">
    </form>

    <button id="pay-btn" class="btn btn-primary mt-3">
        Approve UPI Autopay
    </button>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('pay-btn').onclick = function(e){
        e.preventDefault();

        var options = {
            key: "{{ $key }}",
            subscription_id: "{{ $subscriptionId }}",
            name: "Hasan Hussain Foundation",
            description: "Recurring Donation",
            prefill: {
                name:  "{{ $donor->name }}",
                email: "{{ $donor->email }}",
                contact: "{{ $donor->mobile }}"
            },
            handler: function (response){
                document.getElementById('rzp_payment_id').value      = response.razorpay_payment_id;
                document.getElementById('rzp_subscription_id').value = response.razorpay_subscription_id;
                document.getElementById('rzp_signature').value       = response.razorpay_signature;
                document.getElementById('autopay-form').submit();
            }
        };

        var rzp1 = new Razorpay(options);
        rzp1.open();
    };
</script>
@endsection
