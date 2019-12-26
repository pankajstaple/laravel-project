@extends('layouts.admin')
@section('content')
<style type="text/css">
.challenge-avtar {
    width: 10rem;
    height: 10rem;
    margin: 0 auto;
    background-size: cover;
    background-position: top center;
    border-radius: 6px;
    margin-bottom: 5px;
    background-color: #ededed;
}
.challenge-status {
    background-color: #b8ffd1;
    color: #03ab3f;
    padding: 2px 8px;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: 600;
    border-radius: 3px;
}
.challenge-price {
    font-size: 24px;
    line-height: 1.2;
    font-weight: bold;
    color: #3898db;
}
.user-avtar-pro {
    width: 2.5rem;
    height: 2.5rem;
    margin: 0 auto;
    background-size: cover;
    background-position: top center;
    border-radius: 50%;
    background-color: #ededed;
}
.table-winner th,
.table-winner td {
    vertical-align: middle;
}

.challenge-price-holder {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
    -ms-flex-wrap: wrap;
        flex-wrap: wrap;
}

.challenge-price-wrap {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
        -ms-flex-direction: row;
            flex-direction: row;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
}

.challenge-price-label {
    color: #636363;
    margin-right: 10px;
}



.custom-control-label::before {
    position: absolute;
    top: 0;
    left: 10px;
    display: block;
    width: 2rem;
    height: 2rem;
    pointer-events: none;
    content: "";
    background-color: #fff;
    border: #adb5bd solid 1px;
}

.custom-control-label::before, .custom-file-label, .custom-select {
    transition: background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.custom-checkbox .custom-control-label::before {
    border-radius: .25rem;
}

.custom-control-label::after {
    position: absolute;
    top: 0;
    left: 10px;
    display: block;
    width: 2rem;
    height: 2rem;
    content: "";
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 50% 50%;
}

.custom-control-input:checked ~ .custom-control-label::before {
    color: #fff;
    border-color: #007bff;
    background-color: #007bff;
}

.custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
    background-color: #3498db;
}

.custom-checkbox .custom-control-input:checked ~ .custom-control-label::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e");
}

.is_winner_checkbox .custom-control-label::after,
.is_winner_checkbox  .custom-control-label::before  {
    /*left: 0;*/
}
</style>
<div class="page-content fade-in-up">
@include('elements.printerror')
    <div class="ibox">
        
        <div class="ibox-head">
            <div class="ibox-title">{{$challenge->title}} Details</div>
        </div>
        <div class="ibox-body">
            <div class="single-challenge-wrap mb-4">
                <div class="row align-items-start">
                    <div class="col-auto">

                      @if(isset($challenge->challenge_image))
                      <div class="challenge-avtar" style="background-image: url({{ config('constants.challenge_image_path').'/'.$challenge->challenge_image}});">
                          
                      </div>
                    @else
                  

                    <div class="challenge-avtar" style="background-image: url({{ url('/').'/admintheme/img/no-image.png'}});"></div>
                  @endif


                        
                    </div>
                    <div class="col">
                        <h4 class="challenge-title mb-2 mt-1">{{$challenge->title}} <small class="challenge-status">{{$challenge->status}}</small></h4>
                        <div class="challenge-timeduration text-muted mb-2"><span class="challenge-access">{{ucfirst($challenge->challenge_access)}}</span> {{$challenge->start_date}} to {{$challenge->end_date}}</div>
                        <p class="challenge-discription mb-2">{{$challenge->description}}</p>
                        <div class="challenge-price-holder">
                            <div class="challenge-price-wrap">
                                <div class="challenge-price-label">Challenge Amount:</div>
                                <div class="challenge-price">${{$challenge->amount}}</div>
                            </div>
                            <div class="challenge-price-wrap">
                                <div class="challenge-price-label">Pot Amount:</div>
                                <div class="challenge-price">${{$challenge->amount * $challenge->get_participant_count}}</div>                     
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section>
                <h3>Participants</h3>
                @if(count($challenge->getParticipant) > 0)
                {{ Form::open(array('url' => 'admin/challenge/winner/'.base64_encode($challenge->id), 'id' => 'AddChallengeForm',)) }}
                <input type="hidden" id="winner_amt" value="{{$winner_amt}}">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-winner" id="users-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 5rem">Is Win</th>
                                <th style="width: 4.5rem">Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Winner Amount</th>
                                <th style="width: 5rem">Weigh-in</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Is Win</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Winner Amount</th>
                                <th>Weigh-in</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        
                        @foreach($challenge->getParticipant as $key=>$u)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox is_winner_checkbox">
                                      <input type="checkbox" data-id="{{$key}}" class="custom-control-input is_winner" id="customCheck_{{$key}}" {{in_array($u->user_id,$winner_users)?'checked="checked"':''}} name="is_winner[]" value="{{$u->user_id}}" >
                                      <label class="custom-control-label" for="customCheck_{{$key}}">&nbsp;</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="user-avtar-pro" style="background-image: url({{ public_path('/').'profile_image'.'/'.$u['participantUser']['profile']['profile_image']}});"></div>
                                </td>
                                <td>{{$u['participantUser']['first_name']}} {{$u['participantUser']['last_name']}}</td>
                                <td>{{$u['participantUser']['email']}}</td>
                                <td>{{$u['participantUser']['profile']['contact']}}</td>
                                <td class="won_amount won_amount_{{$key}}">{{in_array($u->user_id,$winner_users)?$winner_amount:'0'}}</td>
                                <td>
                                    <a href="{{url('/')}}/admin/challenge/participant/weighin/{{base64_encode($u->user_id)}}/{{base64_encode($challenge->id)}}/winner" class="btn btn-primary">View Weign-in</a>
                                </td>
                            </tr>
                        @endforeach   
                       
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{route('winner')}}" class="btn btn-secondary">Back</a>
                    {{ Form::button('Submit Winner', ['class' => 'btn btn-success add-challenge','id'=>'submit_winner_btn'])}}
                </div>

                {{ Form::close() }}

                @else

                No Result Found </br>
                 <a href="{{route('winner')}}" class="btn btn-secondary">Back</a>

                @endif
            </section>
     
           
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">

$(document).ready(function(){
    $("#submit_winner_btn").click(function(){
         var is_won = $('input:checkbox.is_winner:checked').length
        
        if(is_won == 0){
             alert('Select one winner');
            return false;
        }


        $("#AddChallengeForm").submit();

    });


    $(".is_winner").change(function(){
         $(".won_amount").text('0');
        var is_won = $('input:checkbox.is_winner:checked').length;
        if(is_won == 0){
            return false;
        }
       
        var winner_amt = $("#winner_amt").val();
        var won_amount = (winner_amt) / (is_won);
         won_amount = won_amount.toFixed(2);

       $('input:checkbox.is_winner:checked').each(function() {
                var id = $(this).data('id');
                $(".won_amount_"+id).text(won_amount);
            });

    });
      });
</script>


@endsection('scripts')