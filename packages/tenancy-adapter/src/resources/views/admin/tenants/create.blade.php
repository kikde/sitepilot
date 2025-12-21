<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Create Tenant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  </head>
  <body class="container">
    <nav>
      <ul>
        <li><strong>Tenancy Admin</strong></li>
      </ul>
      <ul>
        <li><a href="{{ route('tenancy.admin.tenants.index') }}">Back</a></li>
      </ul>
    </nav>

    <h2>Create Tenant</h2>
    <form method="post" action="{{ route('tenancy.admin.tenants.store') }}">
      @csrf
      <label>
        Name
        <input type="text" name="name" value="{{ old('name') }}" required>
      </label>
      <label>
        Slug (optional)
        <input type="text" name="slug" value="{{ old('slug') }}" placeholder="auto from name if empty">
      </label>

      @if($errors->any())
        <article class="contrast">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </article>
      @endif

      <button type="submit">Create</button>
    </form>
  </body>
</html>

