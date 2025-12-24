@if (session('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
@endif

@if (session('status'))
  <div class="alert alert-info" role="alert">
    {{ session('status') }}
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger" role="alert">
    {{ session('error') }}
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger" role="alert">
    <ul class="mb-0" style="margin:0;padding-left:18px;">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif