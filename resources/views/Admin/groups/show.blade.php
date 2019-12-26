@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">

 <div class="row">
  <div class="col-md-12">
      <div class="ibox">
         <div class="ibox-body">

          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Group Details</h3>
            </div>
            <div class="panel-body">
              
              <div class="row">
                
                <div class=" col-md-12 col-lg-12 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Title:</td>
                        <td>{{$group->title}}</td>
                      </tr>
                      <tr>
                        <td>Status:</td>
                        <td>{{ $group->status }}</td>
                      </tr>
                      <tr>
                        <td>Total Likes:</td>
                        <td>{{$total_likes}}</td>
                      </tr>
                      <tr>
                        <td>Total Comments:</td>
                        <td>{{$total_comments}}</td>
                      </tr>
                      <tr>
                        <td>Total Members:</td>
                        <td> ({{$total_members}})
                          @if(!$members->isEmpty())
                         <div class="added_member">
                         @foreach($members as $member)
                        <span class="member_item">
                          <span class="member_name">{{$member->group_user->first_name .' '.$member->group_user->last_name}}</span>
                        </span>
                      @endforeach
                      </div>
                      @endif
                    </td>
                      </tr>
    
                      <tr>
                        <td>Content:</td>
                        <td>{!!html_entity_decode($group->about) !!}</td>
                      </tr>
                      <tr>
                        <td>Created By:</td>
                        <td>{{ $group->getcreatedby->first_name }} {{ $group->getcreatedby->last_name }}</td>
                      </tr>
                      <tr>
                        <td>Created date:</td>
                        <td>{{!empty($group->created_at)?$group->created_at->format('d/m/Y'):""}}</td>
                      </tr>

                       
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class=" col-md-12 col-lg-12 "> 
                <div class="col-md-3 col-lg-3 " align="center"> 
                  <label>Banner Image</label>
                  @if(isset($group->banner_image))
                    <img class="img-responsive" src="{{ config('constants.group_img_path').'/'.$group->banner_image}}" >
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