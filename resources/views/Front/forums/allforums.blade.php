@extends('layouts.front')
@section('title', 'All Forums')
@section('content')
    <div class="container" style="max-width: 900px!important;">
      <section class="forums-wrap py-5">
        <div class="forums-list" id="listings">
        @include('elements.forumlist')
        </div>
      </section>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(function(){

    $(document).on('click', '#view-more-listings', function(){
      $('.loader').show();
      var currObj = $(this);
        $.ajax({
            type: 'GET',
            url:$(this).data("url"),
            success: function (response) {
               $("#listings").append(response);
               currObj.parent().remove();
               $('.loader').hide();
            },
            error: function (error) {
              $('.loader').hide();
              alert('Please refresh the page or try again');
             
            }
        });
      
    });
    

  });

</script>
@stop

<style type="text/css">
  .load_more_btns {
      background: #d3b349;
      padding: 10px 30px;
      border: 1px solid #d3b349;
      border-radius: 5px;
      color: #000 !important;
      display: inline-block;
  }
</style>