@extends('layouts.front')
@section('title', 'All Groups')
@section('content')
  <div class="sub-header py-5 mb-5" style="background-image: url({{ asset('fronttheme/images/groupsubheader-bg.jpg')}})">
    <div class="sub-header-content py-5">
      <h2 class="display-4">Join a Group!</h2>
      <p class="mb-0">Join our community to start reaching your goals.</p>      
    </div>
  </div>
      <div class="container">
        <section class="searchBar mb-5">
          <form  method="get">
            <div class="form-row">
              <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Find group here...">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-black">Find Group</button>
              </div>
              
             @if(Auth::check() && CustomHelper::checkPermission('create_new_group'))
              <div class="col-auto">
                <a href="{{url('/groups/create_new_group')}}" class="btn btn-yellow">Create New Group</a>
              </div>
              @endif
            </div>
          </form>
        </section>

        @if(session()->has('success'))
           <div class="alert alert-success">
              {{ session()->get('success') }}
           </div>
        @endif

        <section class="find-groups mb-5">
          <div class="find-group-list">
            @include('elements.grouplist')
          </div>

        </section>
        <div class="d-flex justify-content-center">
         {{ $groups->links() }}
          <!----nav aria-label="...">
            <!----ul class="pagination">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item active">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul----->
          </nav----->
        </div>
        
    </div>
@endsection
@section('scripts')


</script>
@stop
