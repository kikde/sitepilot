@extends('layouts.master')

@section('content')
<section class="sec-pad">
    <div class="auto-container text-center">
        <h2>Donation Failed / Cancelled</h2>
        <p>It looks like your payment did not complete.</p>
        <p>You can try again or contact us if the amount was deducted.</p>

        <a href="{{ url('/user-donate') }}" class="btn btn-primary mt-3">
            Try Again
        </a>
    </div>
</section>
@endsection
