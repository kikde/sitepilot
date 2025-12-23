@extends('layouts.master')

@section('content')
<section class="page-title style-two centred" style="background-image: url({{ asset('frontend/assets/images/background/donation.png') }});">
  <div class="auto-container">
    <div class="content-box">
      <div class="title"><h1>Donations</h1></div>
      <ul class="bread-crumb clearfix">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li>Donations</li>
      </ul>
    </div>
  </div>
</section>

<section class="service-style-three sec-pad-2 elements">
  <div class="auto-container">
    @if($rows instanceof \Illuminate\Contracts\Pagination\Paginator || $rows instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
      @if($rows->count())
        <div class="table-responsive">
          <table class="table" style="border-collapse:separate;border-spacing:0;">
            <thead>
              <tr>
                <th>Donor</th>
                <th>Amount (INR)</th>
                <th>Payment ID</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
            @foreach($rows as $d)
              <tr>
                <td>{{ $d->donor->name ?? '—' }}</td>
                <td>{{ number_format((float)($d->amount_paise ?? 0)/100, 2) }}</td>
                <td style="word-break:break-all">{{ $d->razorpay_payment_id ?? '—' }}</td>
                <td>{{ optional($d->updated_at ?? $d->created_at)->format('d M Y') }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        {{ $rows->links('vendor.pagination.default') }}
      @else
        <p>No donations found.</p>
      @endif
    @else
      <p>No donations found.</p>
    @endif
  </div>
</section>
@endsection