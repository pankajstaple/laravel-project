@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">

 <div class="row">
  <div class="col-md-12">
      <div class="ibox">
         <div class="ibox-body">

          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{ $challenge->title}}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> 
                  @if(isset($challenge->challenge_image))
                    <img class="img-circle img-responsive" src="{{ config('constants.challenge_image_path').'/'.$challenge->challenge_image}}" >
                    @else
                    <img class="img-circle img-responsive" src="{{ url('/').'/admintheme/img/no-image.png'}}" >
                  @endif
                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Title:</td>
                        <td>{{$challenge->title}}</td>
                      </tr>
                      <tr>
                        <td>Description:</td>
                        <td>{{$challenge->description}}</td>
                      </tr>
                      <tr>
                        <td>Amount:</td>
                        <td>${{$challenge->amount}}</td>
                      </tr>
                      <tr>
                        <td>Status:</td>
                        <td>{{$challenge->status}}</td>
                      </tr>
                      <tr>
                        <td>Created By:</td>
                        <td>{{$challenge->getcreatedby->first_name." ".$challenge->getcreatedby->last_name}}</td>
                      </tr>
                      <tr>
                        <td>Created date:</td>
                        <td>{{!empty($challenge->created_at)?$challenge->created_at->format('d/m/Y'):""}}</td>
                      </tr>
                      <tr>
                        <td>Start Date</td>

                        <td>
                          @if(!empty($challenge->start_date))
                                @php
                                {{ $start_date = date('d/m/Y', strtotime($challenge->start_date)); }}
                          @endphp
                                {{ $start_date }}
                                @endif
                      </tr>
                      <tr>
                        <td>End Date</td>

                        <td>
                          @if(!empty($challenge->end_date))
                                @php
                                {{ $end_date = date('d/m/Y', strtotime($challenge->end_date)); }}
                          @endphp
                                {{ $end_date }}
                                @endif
                      </tr>
                      <tr>
                        <td>Bet Close Date</td>

                        <td>
                          @if(!empty($challenge->bet_close_date))
                                @php
                                {{ $bet_close_date = date('d/m/Y', strtotime($challenge->bet_close_date)); }}
                          @endphp
                                {{ $bet_close_date }}
                                @endif
                      </tr>

                       <tr>
                        <td>Challenge Access</td>

                        <td>
                          @if(!empty($challenge->challenge_access))
                               
                                {{ucfirst($challenge->challenge_access)}}
                          @else
                                {{ucfirst($challenge->challenge_access)}}
                                @endif
                      </tr>
                      
                     
                    </tbody>
                  </table>
                  
                  <!--<a href="#" class="btn btn-primary">My Sales Performance</a>
                  <a href="#" class="btn btn-primary">Team Sales Performance</a> -->
                </div>
              </div>
            </div>
            <!--
                 <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>
            -->
          </div>
          </div>
         

</div>
  </div>
 </div>
</div>
@endsection