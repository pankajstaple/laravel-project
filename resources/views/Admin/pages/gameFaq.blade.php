@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="ibox">
        @include('elements.printerror')
        <div class="ibox-head">
            <div class="ibox-title">Game Faq List</div>
        </div>
        <div class="ibox-body">
             <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="input-group">
                        <a class="btn btn-primary add-coupon-btn" href="{{URL('/admin/pages/addgamefaq')}}">+ ADD NEW</a>
                    </div>
                </div>
             </div>
            <!--{!! Form::open(['method'=>'get']) !!}
            <div class="row">
                <div class="col-sm-5 form-group">
                    <div class="input-group">
                        <input class="form-control" id="search"
                               value="{{ request('search') }}"
                               placeholder="Search name or email" name="search"
                               type="text" id="search"/>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-warning"
                            >
                                Search
                            </button>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{request('field')}}" name="field"/>
                <input type="hidden" value="{{request('sort')}}" name="sort"/>
            </div>
            {!! Form::close() !!}-->
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="users-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>@sortablelink('question', "Question")</th>
                        <th>@sortablelink('answer', "Answer")</th>
                        <th>@sortablelink('updated_at', "Updated")</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($faqs) > 0)
                    @foreach($faqs as $faq)
                    <tr>
                        <td>{{ str_limit($faq->question, 30, '...') }}</td>
                        <td>{{ str_limit(strip_tags($faq->answer), 30, '...') }}</td>
                        <!--<td>
                            <span title="" data-toggle="tooltip" class="label label-info" data-original-title="Total Reads"><i class="fa fa-eye"></i> 0</span>
                            <span title="" data-toggle="tooltip" class="label label-success" data-original-title="Helpful Yes"><i class="fa fa-thumbs-up"></i> </span>
                            <span title="" data-toggle="tooltip" class="label label-danger" data-original-title="Helpful No"><i class="fa fa-thumbs-up"></i> </span>
                        </td>-->
                        <td>{{ ($faq->updated_at)?$faq->updated_at->format('d/m/Y'):"" }}</td>
                        <td>
                            <a href="{{ URL('/admin/pages/updategamefaq/'.base64_encode($faq->id))}}"  class="editfaq">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('deletegamefaq', base64_encode($faq->id)) }}" method="get" class="TypeDeleteForm disp-inline">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <a onclick="$(this).closest('form').submit();" href="javascript:;">
                                    <i class="fa fa-trash"></i>
                                </a>
                                
                            </form>
                            
                        </td>
                    </tr>
                  
                    @endforeach
                    @else
                        <tr><td colspan="6">No record to display.</td></tr>
                    @endif
                    
                </tbody>
            </table>
            </div>
            {{ $faqs->appends($_GET)->links() }}
        </div>

    </div>
</div>

@endsection