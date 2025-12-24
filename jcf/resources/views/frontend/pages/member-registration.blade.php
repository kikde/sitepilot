@extends('layouts.master')
@section('content')

@if(session('success') || session('error') || session('message'))
  <div style="max-width:960px;margin:16px auto 0;padding:12px 16px;border-radius:8px;{{ session('error') ? 'background:#ffe6e6;color:#a30000;border:1px solid #ffb3b3;' : 'background:#e8fff0;color:#085c2e;border:1px solid #b9f0cd;' }}">
    <span>{!! session('success') ?? session('message') ?? session('error') !!}</span>
    @if(session('success'))
      <a href="{{ route('member.register.show') }}" style="float:right;text-decoration:none;padding:4px 10px;border-radius:6px;background:#fff;color:#085c2e;border:1px solid #85e0b0;">Back to Registration</a>
    @endif
  </div>
@endif


@include ("frontend.partials.forms.member.style-1")

@include('frontend.partials.donate.style-2')

@endsection
