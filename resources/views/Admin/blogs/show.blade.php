@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">

 <div class="row">
  <div class="col-md-12">
      <div class="ibox">
         <div class="ibox-body">

          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Blog Details</h3>
            </div>
            <div class="panel-body">
              
              <div class="row">
                
                <div class=" col-md-12 col-lg-12 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Title:</td>
                        <td>{{$blog->title}}</td>
                      </tr>
                      <tr>
                        <td>Summary:</td>
                        <td>{{$blog->summary}}</td>
                      </tr>
                      <tr>
                        <td>Category:</td>
                        <td>{{$blog->getblogcategory->name}}</td>
                      </tr>
                      <tr>
                        <td>Is published:</td>
                        <td>{{($blog->is_published == 1)?"Yes":"No"}}</td>
                      </tr>
                      <tr>
                        <td>Total Likes:</td>
                        <td>{{$blog->total_likes}}</td>
                      </tr>
                      <tr>
                        <td>Total Views:</td>
                        <td>{{$blog->total_views}}</td>
                      </tr>
                      <tr>
                        <td>Facebook Shares:</td>
                        <td>{{$blog->facebook_shares}}</td>
                      </tr>
                      <tr>
                        <td>Content:</td>
                        <td>{!!html_entity_decode($blog->content) !!}</td>
                      </tr>
                      <tr>
                        <td>Created By:</td>
                        <td>{{$blog->getcreatedby->first_name." ".$blog->getcreatedby->last_name}}</td>
                      </tr>
                      <tr>
                        <td>Created date:</td>
                        <td>{{!empty($blog->created_at)?$blog->created_at->format('d/m/Y'):""}}</td>
                      </tr>

                       
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class=" col-md-12 col-lg-12 "> 
                <div class="col-md-3 col-lg-3 " align="center"> 
                  @if(isset($blog->blog_image))
                    <img class="img-responsive" src="{{ config('constants.blog_img_path').'/'.$blog->blog_image}}" >
                    @else
                    <img class="img-responsive" src="{{ url('/').'/admintheme/img/no-image.png'}}" >
                  @endif
                </div>
                </div>
              </div>

            </div>
          
          </div>
          </div>
         

</div>
  </div>
 </div>
</div>
@endsection