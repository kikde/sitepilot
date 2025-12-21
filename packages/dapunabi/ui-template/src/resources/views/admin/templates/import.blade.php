@extends('coreauth::layouts.base')

@section('content')
  <div class="container py-4">
    <h2>Import Template (ZIP)</h2>
    @if(session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form method="post" action="{{ route('uitpl.admin.templates.import.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label class="form-label">ZIP File</label>
        <input type="file" name="zip" class="form-control" accept=".zip" required>
      </div>
      <button class="btn btn-primary">Import into this tenant</button>
    </form>
  </div>
@endsection
