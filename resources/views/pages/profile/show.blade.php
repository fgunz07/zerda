@extends('layouts.app')
@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body box-profile" id="profile">

                    <div class="pull-right">
                        <a href="" class="editInline"  data-toggle="modal" data-target="#change-profile"><i class="glyphicon glyphicon-pencil"></i></a>
                    </div>
                    <img  class="profile-user-img img-responsive img-circle "  src="{{url('/images/user4-128x128.jpg')}}" alt="User profile picture"/>
                    
                    <h3 class="profile-username text-center">Nina Mcintire</h3>
                   
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="pull-left">
                        <h3 class="box-title">About Me</h3>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" >

                    <div id="education">
                        <strong><i class="fa fa-book margin-r-5"></i>Education</strong>
                        <a href="" class="editInlineEdu" data-toggle="modal" data-target="#change-education"><i class="glyphicon glyphicon-pencil"></i></a>     
                    </div>
                    
                    <p class="text-muted">
                        <strong>Tertiary:</strong>
                    </p>

                    <p class="text-muted">
                        <strong>Secondary:</strong>
                    </p>

                    <p class="text-muted">
                        <strong>Primary:</strong>
                    </p>

                    <hr>

                    <div id="location">
                        <strong><i class="fa fa-map-marker margin-r-5"></i>Location</strong>
                        <a href="" class="editInlineLocation" data-toggle="modal" data-target="#change-location"><i class="glyphicon glyphicon-pencil"></i></a>
                    </div>

                    <p class="text-muted"></p>

                    <hr>

                    <div id="skills">
                        <strong><i class="fa fa-pencil margin-r-5"></i>Skills</strong>
                        <a href="" class="editInlineSkills" data-toggle="modal" data-target="#change-skills"><i class="glyphicon glyphicon-pencil"></i></a>
                    </div>

                    <p>
                        @foreach($specializations as $skill)
                         <span class="label label-success"><li>{{$skill->child_user_specilization->name}}</li></span>
                        @endforeach
                    </p>

                    <hr>

                    <div id="notes">
                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                        <a href="" class="editInlineNotes" data-toggle="modal" data-target="#change-notes"><i class="glyphicon glyphicon-pencil"></i></a>
                    </div>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>
            </div>
	    </div>
    </div>

    <div>
        <!-- Change Profile Modal -->
        <div class="modal fade" id="change-profile" role="dialog" style=" overflow-y:scroll;">
            <div class="modal-dialog" style="width:500px">
                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Profile Settings</b></h4>
                    </div>
                    <div class="modal-body">
                        @if (count($errors) > 0)

                        <div class="alert alert-danger">

                            <strong>Whoops!</strong> There were some problems with your input.

                            <ul>        

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                        @endif
                        <div class="an-content-body">
                            <form action="{{ url('profile-upload-pic') }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                <div class="row">
                                    <div class="col-md-12" align="center">
                                        <div class="form-inline">
                                            <div class="form-group">
                                                <img  class="profile-user-img img-responsive img-circle "  src="{{url('/images/avatar.png')}}" alt="User profile picture"/>
                                                <br>
                                                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control pull-left">
                                                <button type="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-upload">Upload</i></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div> <!-- end .AN-COMPONENT-BODY -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <!-- Change Education Modal -->
        <div class="modal fade" id="change-education" role="dialog" style=" overflow-y:scroll;">
            <div class="modal-dialog" style="width:500px">
                {{$errors}}
                <!-- Modal content-->
                <div class="modal-content" >
                    {!! Form::open(['url'=>'profile-education', 'method'=>'POST']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Education Settings</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="an-content-body">
                            <div class="row">

                                <label for="tertiary" class="col-sm-2 control-label">Tertiary:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('tertiary',old('tertiary'),['class'=>'form-control'])!!}
                                </div>

                                <br><br>

                                <label for="secondary" class="col-sm-2 control-label">Secondary:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('secondary',old('secondary'),['class'=>'form-control'])!!}
                                </div>

                                <br><br>

                                <label for="primary" class="col-sm-2 control-label">Primary:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('primary',old('primary'),['class'=>'form-control'])!!}
                                </div>

                            </div>
                        </div> <!-- end .AN-COMPONENT-BODY -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Submit</button> 
                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div>
        <!-- Change Location Modal -->
        <div class="modal fade" id="change-location" role="dialog" style=" overflow-y:scroll;">
            <div class="modal-dialog" style="width:500px">
                {{$errors}}
                <!-- Modal content-->
                <div class="modal-content" >
                    {!! Form::open(['url'=>'profile-location', 'method'=>'POST']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Location Settings</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="an-content-body">
                            <div class="row">

                                <label for="street" class="col-sm-2 control-label">Street:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('street',old('street'),['class'=>'form-control'])!!}
                                </div>

                                <br><br>

                                <label for="brgy" class="col-sm-2 control-label">Barangay:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('brgy',old('brgy'),['class'=>'form-control'])!!}
                                </div>

                                <br><br>

                                <label for="city" class="col-sm-2 control-label">City:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('city',old('city'),['class'=>'form-control'])!!}
                                </div>

                                <br><br>

                                <label for="province" class="col-sm-2 control-label">Province:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('province',old('province'),['class'=>'form-control'])!!}
                                </div>

                                <br><br>

                                <label for="country" class="col-sm-2 control-label">Country:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('country',old('country'),['class'=>'form-control'])!!}
                                </div>

                            </div>
                        </div> <!-- end .AN-COMPONENT-BODY -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Submit</button> 
                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div>
        <!-- Change Skills Modal -->
        <div class="modal fade" id="change-skills" role="dialog" style=" overflow-y:scroll;">
            <div class="modal-dialog" style="width:500px">
                {{$errors}}
                <!-- Modal content-->
                <div class="modal-content" >
                    {!! Form::open(['url'=>'profile-skill-delete/{$skills->id}', 'method'=>'POST']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Skill Settings</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="an-content-body">
                            <div class="row">
                                <div style="padding:10px">
                                     <button type="button" class="btn btn-primary pull-right"  data-toggle="modal" data-target="#add-skills"><i class="glyphicon glyphicon-plus">Skill</i></button>
                                </div>
                                <ul>
                                    @foreach($specializations as $skill)
                                    <li>{{$skill->child_user_specilization->name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div> <!-- end .AN-COMPONENT-BODY -->
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div>
        <!-- Add Skills Modal -->
        <div class="modal fade" id="add-skills" role="dialog" style=" overflow-y:scroll;">
            <div class="modal-dialog" style="width:400px">
                {{$errors}}
                <!-- Modal content-->
                <div class="modal-content" >
                    {!! Form::open(['url'=>'loansldeduc', 'method'=>'POST', 'id'=>'form-loansldeduc']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Add New Skill</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="an-content-body">
                            <div class="row">
                                <label for="description" class="col-sm-2 control-label">Skill:</label>

                                <div class="col-sm-10">
                                    <span>
                                        <select class="form-control"  id="" data-parsley-required="true" name="SLTypeBR_CODE" style="width: 100%;" required="required">
                                        @foreach($skills as $key => $val)
                                            <option value="{{ $val->id }}">{{$val->description}}</option>
                                        @endforeach
                                        </select>
                                    </span>
                                </div>
                            </div>
                        </div> <!-- end .AN-COMPONENT-BODY -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left">Submit</button>
                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div>
        <!-- Change Notes Modal -->
        <div class="modal fade" id="change-notes" role="dialog" style=" overflow-y:scroll;">
            <div class="modal-dialog" style="width:500px">
                {{$errors}}
                <!-- Modal content-->
                <div class="modal-content" >
                    {!! Form::open(['url'=>'loansldeduc', 'method'=>'POST', 'id'=>'form-loansldeduc']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>SLType Loan Deduction Items</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="an-content-body">
                            <div class="row">

                                <div class="col-md-12" align="center">
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <h3 id="deducfor"> </h3>
                                            <form action="upload.php" method="post" enctype="multipart/form-data" class="form-control">
                                            <img  class="profile-user-img img-responsive img-circle "  src="{{url('/images/user4-128x128.jpg')}}" alt="User profile picture"/>
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                            <input type="submit" value="Upload Image" name="submit">
                                        </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- end .AN-COMPONENT-BODY -->
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>


@endsection

@section('custom_js')
  @include('pages.profile.script.profile-script')
@endsection