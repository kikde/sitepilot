@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">RAZORPAY</h4>
            </div>
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ url('/payment-gateways') }}" method="POST">
                    @csrf

                    {{-- Active toggle --}}
                    <div class="d-flex align-items-center mb-2">
                        <span class="mr-1">Active</span>
                        <label class="custom-switch mb-0">
                            <input type="checkbox"
                                   class="custom-switch-input"
                                   name="razorpay_active"
                                   value="1"
                                   {{ old('razorpay_active', $razorpay_active) ? 'checked' : '' }}>
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </div>

                    {{-- Key ID --}}
                    <div class="form-group">
                        <label for="razorpay_key_id">Key id *</label>
                        <input type="text"
                               id="razorpay_key_id"
                               name="razorpay_key_id"
                               class="form-control @error('razorpay_key_id') is-invalid @enderror"
                               value="{{ old('razorpay_key_id', $razorpay_key_id) }}">
                        @error('razorpay_key_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Key secret --}}
                    <div class="form-group">
                        <label for="razorpay_key_secret">Key secret *</label>
                        <input type="text"
                               id="razorpay_key_secret"
                               name="razorpay_key_secret"
                               class="form-control @error('razorpay_key_secret') is-invalid @enderror"
                               value="{{ old('razorpay_key_secret', $razorpay_key_secret) }}">
                        @error('razorpay_key_secret')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
