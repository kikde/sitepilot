@extends('coreauth::layouts.base')

@section('content')
  <h2 style="margin:0 0 12px;">Upload Media</h2>
  <form action="{{ route('media.admin.upload.post') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div style="margin-bottom:10px;">
      <input type="file" name="file" required>
    </div>
    <button class="btn" type="submit">Upload</button>
    <a class="btn btn-outline" href="{{ route('media.admin.index') }}" style="margin-left:8px;">Back</a>
  </form>
@endsection

