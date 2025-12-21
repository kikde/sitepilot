@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Home Award Section</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">Award Section</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addAwardModal">
        <i data-feather="plus"></i> Add Item
      </button>
    </div>
  </div>

  <div class="content-body">
    <div class="card">
      <div class="card-header"><h4 class="card-title mb-0">List</h4></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover-animation">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Status</th>
                <th style="width:110px;">Actions</th>
              </tr>
            </thead>
            <tbody>
            @forelse($rows as $row)
              <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->title }}</td>
                <td class="text-truncate" style="max-width:240px;">{{ $row->images }}</td>
                <td>{{ $row->status }}</td>
                <td>
                  <a href="#" data-toggle="modal" data-target="#editAwardModal{{ $row->id }}"><i data-feather="edit"></i></a>
                  <a href="#" onclick="event.preventDefault();document.getElementById('delAward{{ $row->id }}').submit();"><i data-feather="trash-2" class="ml-50"></i></a>
                  <form id="delAward{{ $row->id }}" action="{{ url('/home/award-section/'.$row->id) }}" method="post" style="display:none;">
                    @csrf
                    @method('DELETE')
                  </form>
                </td>
              </tr>

              <div class="modal fade text-left" id="editAwardModal{{ $row->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Award Item</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ url('/home/award-section/'.$row->id) }}" method="post">
                      @csrf
                      @method('PUT')
                      <div class="modal-body">
                        <div class="form-group">
                          <label>Title</label>
                          <input class="form-control" name="title" value="{{ $row->title }}">
                        </div>
                        <div class="form-group">
                          <label>Image path (or media URL)</label>
                          <input class="form-control" name="images" value="{{ $row->images }}">
                        </div>
                        <div class="form-group">
                          <label>Alt tag</label>
                          <input class="form-control" name="alt_tag" value="{{ $row->alt_tag }}">
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea class="form-control" name="description" rows="4">{{ $row->description }}</textarea>
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                          <input class="form-control" name="status" value="{{ $row->status }}">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            @empty
              <tr><td colspan="5" class="text-center text-muted">No award items found.</td></tr>
            @endforelse
            </tbody>
          </table>
        </div>

        <div class="mt-2 d-flex justify-content-center">
          {{ $rows->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-left" id="addAwardModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Award Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="{{ url('/home/award-section') }}" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Title</label>
            <input class="form-control" name="title">
          </div>
          <div class="form-group">
            <label>Image path (or media URL)</label>
            <input class="form-control" name="images">
          </div>
          <div class="form-group">
            <label>Alt tag</label>
            <input class="form-control" name="alt_tag">
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" rows="4"></textarea>
          </div>
          <div class="form-group">
            <label>Status</label>
            <input class="form-control" name="status" value="active">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

