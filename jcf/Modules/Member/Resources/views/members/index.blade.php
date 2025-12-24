@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Members</h2>
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Members List</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <div class="dropdown">
          <a href="{{ route('members.create') }}" class="btn-icon btn btn-primary btn-round btn-sm">
            <i data-feather="plus"></i>Add New
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="content-body">
    <div class="row" id="table-hover-animation">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Members List</h4>
            <h2 class="text-primary">Custom Url</h2>
          </div>

          <div class="table-responsive">
            <table class="table table-hover-animation">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>ID Card</th>
                  <th>Status</th>
                  <th>View</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
              @forelse(($members ?? collect()) as $lists)
                <tr>
                  <td>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="member-{{ $lists->id }}" value="{{ $lists->id }}">
                      <label class="custom-control-label" for="member-{{ $lists->id }}"></label>
                    </div>
                  </td>

                  <td>
                    @php
                      $img = $lists->images ? asset('backend/uploads/'.$lists->images) : asset('backend/uploads/user.jpg');
                    @endphp
                    <img src="{{ $img }}" class="avatar mr-50" height="90" width="90" alt="Member" />
                  </td>

                  <td>{{ $lists->name }}</td>
                  <td>{{ $lists->mobile }}</td>
                  <td>{{ $lists->email }}</td>

                  {{-- ID Card controls --}}
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-outline-danger dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if ((int)$lists->status === 1)
                          <span class="text-success">Enabled</span>
                        @else
                          <span class="text-danger">Disabled</span>
                        @endif
                      </button>

                      @if ((int)$lists->status === 1 && !empty($lists->screenshot))
                        <a href="{{ url('storage/'.$lists->screenshot) }}" class="btn btn-outline-danger waves-effect" download>
                          <i data-feather="download"></i>
                        </a>
                      @else
                        <a href="#" class="btn btn-outline-secondary waves-effect" onclick="return false;">Active First</a>
                      @endif

                      <div class="dropdown-menu">
                        @if ((int)$lists->status === 0)
                          <a class="dropdown-item text-success" href="{{ url('/member/'.$lists->id.'/idcard/active') }}">Enable</a>
                        @endif
                        @if ((int)$lists->status === 1)
                          <a class="dropdown-item text-danger" href="{{ url('/member/'.$lists->id.'/idcard/deactive') }}">Disable</a>
                        @endif
                      </div>
                    </div>
                  </td>

                  <td>
                    @if ((int)$lists->status === 1)
                      <span class="badge badge-pill badge-light-primary mr-1">Active</span>
                    @else
                      <span class="badge badge-pill badge-light-danger mr-1">Inactive</span>
                    @endif
                  </td>

                  <td>
                    <a href="{{ route('members.show', $lists->id) }}" target="_blank" title="View">
                      <i data-feather="eye"></i>
                    </a>
                  </td>

                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                        <i data-feather="more-vertical"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('members.edit', $lists->id) }}">
                          <i data-feather="edit-2" class="mr-50"></i>
                          <span>Edit</span>
                        </a>

                        <a class="dropdown-item" href="{{ route('members.destroy', $lists->id) }}"
                           onclick="event.preventDefault(); document.getElementById('delete-member-{{ $lists->id }}').submit();">
                          <i data-feather="trash" class="mr-50"></i>
                          <span>Delete</span>
                        </a>

                        <form id="delete-member-{{ $lists->id }}" action="{{ route('members.destroy', $lists->id) }}" method="post" style="display:none;">
                          @csrf
                          @method('DELETE')
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="9" class="text-center">No members found.</td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>

          {{-- Pagination --}}
          @if (isset($members) && method_exists($members, 'links'))
            <nav aria-label="Page navigation">
              <div class="d-flex justify-content-center mt-2">
                {{ $members->links('vendor.pagination.default') }}
              </div>
            </nav>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
<script>
$(function () {
  $('input:checkbox').on('change', function () {
    const ids = $('input:checkbox:checked').map(function () { return this.value; }).get().join(',');
    $('h2.text-primary').text('https://ngo.kikde.com/member-query/' + ids);
  });
});
</script>
