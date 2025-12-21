@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Home Award Static Section</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">Award Static</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="content-body">
    <div class="card">
      <div class="card-header"><h4 class="card-title mb-0">Edit</h4></div>
      <div class="card-body">
        <form action="{{ url('/home/static-section') }}" method="post">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label>Heading</label>
            <input class="form-control" name="heading" value="{{ $row->heading ?? '' }}">
          </div>

          <div class="form-group">
            <label>Subheading</label>
            <textarea class="form-control" name="subheading" rows="4">{{ $row->subheading ?? '' }}</textarea>
          </div>

          <div class="form-group">
            <label>Background image path (or media URL)</label>
            <input class="form-control" name="background" value="{{ $row->background ?? '' }}">
          </div>

          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

