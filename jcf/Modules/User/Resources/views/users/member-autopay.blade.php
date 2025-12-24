@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-3">Setup Membership UPI Autopay</h2>
    <p>Hi <strong>{{ $user->name }}</strong>, click below to approve recurring membership payment.</p>

    <form id="autopay-form" action="{{ $callbackRoute }}" method="POST">
        @csrf
        <input type="hidden" name="razorpay_payment_id"      id="rzp_payment_id">
        <input type="hidden" name="razorpay_subscription_id" id="rzp_subscription_id">
        <input type="hidden" name="razorpay_signature"       id="rzp_signature">
    </form>

    <button id="pay-btn" class="btn btn-primary mt-3">
        Approve Membership Autopay
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
        description: "Membership Autopay",
        prefill: {
            name:  "{{ $user->name }}",
            email: "{{ $user->email }}",
            contact: "{{ $user->mobile }}"
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
