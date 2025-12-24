@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="content-header row">
    <div class="col-12 d-flex align-items-center justify-content-between">
      <h2 class="content-header-title mb-0">Home About Section</h2>
    </div>
  </div>

  <div class="content-body">
    @if(session('message'))
      <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="card">
      <div class="card-body">
        <form method="post" action="{{ route('home.about.update') }}">
          @csrf
          <div class="mb-1">
            <label class="form-label">Section Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $data['title'] ?? 'About Us') }}">
          </div>

          <div class="mb-1">
            <label class="form-label">Mission (HTML allowed)</label>
            <textarea class="form-control" rows="6" name="mission">{{ old('mission', $data['mission'] ?? '') }}</textarea>
          </div>

          <div class="mb-1">
            <label class="form-label">Vision (HTML allowed)</label>
            <textarea class="form-control" rows="6" name="vision">{{ old('vision', $data['vision'] ?? '') }}</textarea>
          </div>

          <div class="mb-1">
            <label class="form-label">Values (HTML allowed)</label>
            <textarea class="form-control" rows="6" name="values">{{ old('values', $data['values'] ?? '') }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

