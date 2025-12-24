@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card p-2 p-md-3">
    <h4 class="mb-2">Payments for: {{ $user->name }} (ID: {{ $user->id }})</h4>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @php $pageErr = session('error'); @endphp
    @if($pageErr && $pageErr !== 'Page not found.')
      <div class="alert alert-danger">{{ $pageErr }}</div>
    @endif

    @if($payments->isEmpty())
      <p class="text-muted m-2">No payments found for this member.</p>
    @else
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Razorpay Order</th>
              <th>Payment ID</th>
              <th>Status</th>
              <th>Amount</th>
              <th>Currency</th>
              <th>Receipt / Screenshot</th>
              <th>Verified?</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($payments as $payment)
              @php
                $shot = $payment->screenshot;
                $shotUrl = $shot ? asset('storage/'.ltrim($shot,'/')) : null;
              @endphp
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $payment->razorpay_order_id }}</td>
                <td>{{ $payment->razorpay_payment_id }}</td>
                <td>{{ $payment->status }}</td>
                <td>{{ $payment->amount ? '-' }}</td>
                <td>{{ $payment->currency }}</td>
                <td>
                  @if($shotUrl)
                    <a href="{{ $shotUrl }}" target="_blank" rel="noopener">Open file</a>
                  @else
                    <span class="text-muted">—</span>
                  @endif
                </td>
                <td>
                  @if($payment->is_verified)
                    <span class="badge badge-success">Verified</span>
                    <small class="text-muted d-block">{{ optional($payment->verified_at)->format('d-m-Y H:i') }}</small>
                  @else
                    <span class="badge badge-secondary">Pending</span>
                  @endif
                </td>
                <td>
                  @if(!$payment->is_verified)
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#payModal-{{ $payment->id }}">
                      Review & Verify
                    </button>

                    <div class="modal fade" id="payModal-{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="payModalLabel-{{ $payment->id }}" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="payModalLabel-{{ $payment->id }}">Payment Review</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6">
                                <dl class="row mb-0">
                                  <dt class="col-5">Order ID</dt>
                                  <dd class="col-7">{{ $payment->razorpay_order_id ?? '—' }}</dd>
                                  <dt class="col-5">Payment ID</dt>
                                  <dd class="col-7">{{ $payment->razorpay_payment_id ?? '—' }}</dd>
                                  <dt class="col-5">Status</dt>
                                  <dd class="col-7">{{ $payment->status ?? '—' }}</dd>
                                  <dt class="col-5">Amount</dt>
                                  <dd class="col-7">{{ $payment->amount ? '-' }} {{ $payment->currency }}</dd>
                                  <dt class="col-5">Created</dt>
                                  <dd class="col-7">{{ optional($payment->created_at)->format('d-m-Y H:i') }}</dd>
                                </dl>
                              </div>
                              <div class="col-md-6">
                                @if($shotUrl)
                                  <img src="{{ $shotUrl }}" alt="Payment screenshot" class="img-fluid rounded border">
                                  <div class="mt-1"><a href="{{ $shotUrl }}" target="_blank" rel="noopener">Open original</a></div>
                                @else
                                  <div class="text-muted">No screenshot uploaded.</div>
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form action="{{ route('admin.payments.verify', $payment->id) }}" method="post" class="ml-1">
                              @csrf
                              <button type="submit" class="btn btn-success">Mark Verified & Activate</button>
                            </form>
                              <form action="{{ url('/payments/'.$payment->id) }}" method="post" class="ml-1" onsubmit="return confirm('Delete this payment? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" title="Delete payment"><i data-feather="trash"></i></button>
                              </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  @else
                    <small class="text-muted">Already verified</small>
                  @endif

                  <form action="{{ url('/payments/'.$payment->id) }}" method="post" class="d-inline-block ml-1" onsubmit="return confirm('Delete this payment? This cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete payment"><i data-feather="trash"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</div>
@endsection
