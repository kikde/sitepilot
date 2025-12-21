@extends('coreauth::layouts.base')

@section('content')
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Plans</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Plans</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif

  <div class="row">
    <div class="col-lg-4 col-12">
      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0">Create Plan</h4></div>
        <div class="card-body">
          <form method="POST" action="{{ route('billing.admin.plans.store') }}">
            @csrf
            <div class="form-group">
              <label>Code</label>
              <input class="form-control" type="text" name="code" value="{{ old('code') }}" required>
            </div>
            <div class="form-group">
              <label>Name</label>
              <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
              <label>Interval</label>
              <select class="form-control" name="interval">
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
              </select>
            </div>
            <div class="form-group">
              <label>Price</label>
              <input class="form-control" type="number" step="0.01" name="price" value="{{ old('price', '19.00') }}" required>
            </div>
            <div class="form-group">
              <label>Seat Limit (optional)</label>
              <input class="form-control" type="number" min="0" name="seat_limit" value="{{ old('seat_limit') }}" placeholder="10">
            </div>
            <button class="btn btn-primary btn-block" type="submit">Create</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-8 col-12">
      <div class="card">
        <div class="card-header"><h4 class="card-title mb-0">All Plans</h4></div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Interval</th>
                <th>Price</th>
                <th>Seats</th>
                <th>Active</th>
              </tr>
            </thead>
            <tbody>
              @foreach($plans as $p)
                <tr>
                  <td><code>{{ $p->code }}</code></td>
                  <td>{{ $p->name }}</td>
                  <td>{{ ucfirst($p->interval) }}</td>
                  <td>{{ number_format($p->price, 2) }} {{ $p->currency }}</td>
                  <td>{{ $p->seat_limit ?? 'Unlimited' }}</td>
                  <td>{!! $p->active ? '<span class="badge badge-light-success">YES</span>' : '<span class="badge badge-light-secondary">NO</span>' !!}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

