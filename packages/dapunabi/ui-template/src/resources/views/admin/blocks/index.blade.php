@extends('coreauth::layouts.base')

@section('content')
  <div class="container py-4">
    <h2>UI Template — Block Registry</h2>
    @if(session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="row">
      <div class="col-md-6">
        <h5>Registered Blocks</h5>
        <table class="table table-sm">
          <thead><tr><th>Key</th><th>Name</th><th>Category</th></tr></thead>
          <tbody>
          @foreach($blocks as $b)
            <tr>
              <td>{{ $b->code }}</td>
              <td>{{ $b->name }}</td>
              <td>{{ $b->category ?: '-' }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-md-6">
        <h5>Add/Update Block Manifest</h5>
        <form method="post" action="{{ route('uitpl.admin.blocks.store') }}">
          @csrf
          <div class="mb-2">
            <label class="form-label">Manifest (JSON)</label>
            <textarea name="manifest" class="form-control" rows="12" placeholder='{"key":"hero","name":"Hero","fields":{"title":"string"}}'>{{ old('manifest') }}</textarea>
          </div>
          <button type="submit" class="btn btn-primary">Save Manifest</button>
        </form>
        <p class="text-muted mt-2">Required keys: key, name, fields. Optional: defaults, component, preview, category.</p>
      </div>
    </div>
  </div>
@endsection
