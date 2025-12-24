<div class="container">
    @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show mx-5" role="alert">
                    <strong>{{ session()->get('message') }}</strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session()->has('notfound'))
                <div class="alert alert-danger alert-dismissible fade show mx-5" role="alert">
                    <strong>{{ session()->get('notfound') }}</strong>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
             @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mx-5" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
            @endif
</div>