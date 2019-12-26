@extends('layouts.admin')
@section('content')
 <?php //use App\Libraries\Helper;


  ?>
        <!-- dashboard starts here -->
  <div class="container-fluid" id="dashboardbower">
        <div class="create_admin">
                 
                  <a href="{{url('/')}}/admin/permissions" class="btn btn-info submit-bttn">ALL PERMISSION </a>
                
                
                  <a href="{{url('/')}}/admin/permissions/create" class="btn btn-info submit-bttn">CREATE NEW PERMISSION </a>
               
                
                  <a href="{{url('/')}}/admin/permission/managegroup" class="btn btn-info submit-bttn">MANAGE PERMISSION GROUP</a>
               
                  
                  <a href="{{url('/')}}/admin/permission/manageuser" class="btn btn-info submit-bttn">MANAGE USER PERMISSION </a>
                 
            </div>
            <h1>Create New Permission</h1>
            {!! Form::open(['url' => url('/admin/permissions'), 'id'=>'createNewuserForm',  'class' => 'my_form  form-horizontal createNewuserForm new-usr m-t-20 data-parsley-validate novalidate  '] ) !!}

                <h4>YOU ARE CREATING PERMISSION FOR USER</h4>
                <div class="form-group col-md-6 pad-0">
                     
                      {{ Form::label(__('Name:'))}} <span class="req">*</span>
                    <div class="col-sm-12">
                         {!! Form::text('name', $value = null, ['id'=>'name','class' => 'form-control required removeErrorField', 'placeholder' => 'Ex: Add Weigh IN','required','maxlength'=>'50']) !!}
                         @if ($errors->has('name'))
                            <span class="help-block">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                    </div>
                </div>     
                <div class="form-group col-md-6 pad-0">
                     
                      {{ Form::label(__('Code:'))}} <span class="req">*</span>
                    <div class="col-sm-12">
                         {!! Form::text('code', $value = null, ['id'=>'name','class' => 'form-control required removeErrorField', 'placeholder' => 'EX: add_weigh_in','required','maxlength'=>'50']) !!}
                         @if ($errors->has('name'))
                            <span class="help-block">
                                {{ $errors->first('code') }}
                            </span>
                        @endif
                    </div>
                </div>  
                <div class="form-group col-md-6 pad-0">
                     
                      {{ Form::label(__('Discription'))}} <span class="req">*</span>
                    <div class="col-sm-12">
                         {!! Form::text('description', $value = null, ['id'=>'name','class' => 'form-control required removeErrorField', 'placeholder' => 'Please enter Permission Discription','maxlength'=>'50']) !!}
                         @if ($errors->has('name'))
                            <span class="help-block">
                                {{ $errors->first('code') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-6 pad-0">
                     
                      {{ Form::label(__('SortOrder:'))}} <span class="req">*</span>
                    <div class="col-sm-12">
                         {!! Form::text('sortorder', $value = null, ['id'=>'name','class' => 'form-control required removeErrorField', 'placeholder' => 'EX: 1 and 2','maxlength'=>'50']) !!}
                         @if ($errors->has('name'))
                            <span class="help-block">
                                {{ $errors->first('code') }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group col-md-6 pad-0">
                     
                      {{ Form::label(__('Route:'))}} <span class="req">*</span>
                    <div class="col-sm-12">
                         {!! Form::text('route', $value = null, ['id'=>'name','class' => 'form-control required removeErrorField', 'placeholder' => 'Please enter route','maxlength'=>'50']) !!}
                         @if ($errors->has('route'))
                            <span class="help-block">
                                {{ $errors->first('code') }}
                            </span>
                        @endif
                    </div>
                </div>
                   <div class="form-group col-md-6 pad-0 ">
                   
                    {{ Form::label(__('Select Permission Group'))}} <span class="req">*</span>
                     <div class="col-sm-12"> 
                      <select id="role" name="permission_group_name" class="form-control">
                      @foreach($permission_groups as $key=>$r)
                      <option value="{{$key}}">{{$r}}</option>
                       @endforeach
                       </select>
                    </div>
                </div>
                
         
            
              
                <div class="form-group">
                    <div class="col-md-12 col-sm-12">
                        <!-- <button type="submit" class="btn btn-info submit-bttn">Create User</button> -->
                        <button type="submit" class="btn btn-info submit-bttn">Submit</button>
                    </div>
                </div>
                {{ Form::close() }}
            <!-- </form> -->
        </div>
        <!-- dashboard ends here -->
        <script src="{{ asset('js/permission.js') }}" type="text/javascript"></script>
@stop