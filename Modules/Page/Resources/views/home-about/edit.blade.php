@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Home About Section</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">About Tabs Content</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="content-body">
    <section>
      <div class="row">
        <div class="col-md-8">
          @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
          @endif

          <div class="card">
            <div class="card-body">
              <form action="{{ route('home.about.update') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="title">Section Title</label>
                  <input id="title" type="text" name="title" class="form-control" value="{{ old('title', $data['title'] ?? '') }}" maxlength="120" />
                </div>

                <div class="form-group">
                  <label for="mission">Mission (HTML allowed)</label>
                  <textarea id="mission" name="mission" class="form-control" rows="6">{{ old('mission', $data['mission'] ?? '') }}</textarea>
                </div>

                <div class="form-group">
                  <label for="vision">Vision (HTML allowed)</label>
                  <textarea id="vision" name="vision" class="form-control" rows="6">{{ old('vision', $data['vision'] ?? '') }}</textarea>
                </div>

                <div class="form-group">
                  <label for="values">Values (HTML allowed)</label>
                  <textarea id="values" name="values" class="form-control" rows="6">{{ old('values', $data['values'] ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ url('/ngo') }}" target="_blank" class="btn btn-outline-secondary">View Site</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection

