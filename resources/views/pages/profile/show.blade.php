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
                    
                    <img class="profile-user-img img-responsive img-circle " src="/uploads/avatars/{{ $user->avatar }}" alt="User profile picture">
                    @foreach($userName as $user)
                    <h3 class="profile-username text-center">{{$user->last_name}},{{$user->first_name}},{{$user->middle_name}}</h3>
                    @endforeach
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
                    
                   
                    <span><strong>Tertiary:</strong> <p class="text-muted" id="tertiary"></p></span>
                    <span><strong>Secondary:</strong> <p class="text-muted" id="secondary"></p></span>
                    <span><strong>Primary:</strong> <p class="text-muted" id="primary"></p></span>

                    <hr>

                    <div id="location">
                        <strong><i class="fa fa-map-marker margin-r-5"></i>Location</strong>
                        <a href="" class="editInlineLocation" data-toggle="modal" data-target="#change-location"><i class="glyphicon glyphicon-pencil"></i></a>
                    </div>

                    <p class="text-muted" id="location-ni"></p>

                    <hr>

                    <div id="skills">
                        <strong><i class="fa fa-pencil margin-r-5"></i>Skills</strong>
                        <a href="" class="editInlineSkills" data-toggle="modal" data-target="#change-skills"><i class="glyphicon glyphicon-pencil"></i></a>
                    </div>

    
                        <p id="skill"></p>
                  
                    <hr>

                    <div id="achievement">
                        <strong><i class="fa fa-trophy margin-r-5"></i>Achievemet</strong>
                        <a href="" class="editInlineAchievement" data-toggle="modal" data-target="#change-achievement"><i class="glyphicon glyphicon-pencil"></i></a>
                    </div>

    
                        <p id="achievementList"></p>
                  
                    <hr>

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
                   
                        <div class="an-content-body">
                            <form action="{{ url('profile-upload-pic') }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                <div class="row">
                                    <div class="col-md-12" align="center">
                                        <div class="form-inline">
                                            <div class="form-group">
                                                <img  class="profile-user-img img-responsive img-circle "  src="{{url('/images/avatar.png')}}" alt="User profile picture"/>
                                                <br>
                                                <input type="file" name="avatar" id="file" class="form-control pull-left">
                                                <button type="submit" class="btn btn-primary pull-right" id="save-profile"><i class="glyphicon glyphicon-upload">Upload</i></button>
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
                <!-- Modal content-->
                <div class="modal-content" >
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Education Settings</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="an-content-body">
                            <div class="row">

                                <label for="tertiary" class="col-sm-2 control-label">Tertiary:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('tertiary',old('tertiary'),['class'=>'form-control','id'=>'tertiary'])!!}
                                </div>

                                <br><br>

                                <label for="secondary" class="col-sm-2 control-label">Secondary:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('secondary',old('secondary'),['class'=>'form-control','id'=>'secondary'])!!}
                                </div>

                                <br><br>

                                <label for="primary" class="col-sm-2 control-label">Primary:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('primary',old('primary'),['class'=>'form-control','id'=>'primary'])!!}
                                </div>

                            </div>
                        </div> <!-- end .AN-COMPONENT-BODY -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal" id="educ-save">Submit</button> 
                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div>
        <!-- Change Location Modal -->
        <div class="modal fade" id="change-location" role="dialog" style=" overflow-y:scroll;">
            <div class="modal-dialog" style="width:500px">
   
                <!-- Modal content-->
                <div class="modal-content" >
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Location Settings</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="an-content-body">
                            <div class="row">

                                <label for="street" class="col-sm-2 control-label">Street:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('street',old('street'),['class'=>'form-control','id'=>'street'])!!}
                                </div>

                                <br><br>

                                <label for="brgy" class="col-sm-2 control-label">Barangay:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('brgy',old('brgy'),['class'=>'form-control','id'=>'brgy'])!!}
                                </div>

                                <br><br>

                                <label for="city" class="col-sm-2 control-label">City:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('city',old('city'),['class'=>'form-control','id'=>'city'])!!}
                                </div>

                                <br><br>

                                <label for="province" class="col-sm-2 control-label">Province:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('province',old('province'),['class'=>'form-control','id'=>'province'])!!}
                                </div>

                                <br><br>

                                <label for="country" class="col-sm-2 control-label">Country:</label>

                                <div class="col-sm-10">
                                    {!!Form::text('country',old('country'),['class'=>'form-control','id'=>'country'])!!}
                                </div>

                            </div>
                        </div> <!-- end .AN-COMPONENT-BODY -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" id="location-save" >Submit</button> 
                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                    </div>
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
                                <div class="col-md-offset-2">
                                    <div class="col-md-8">
                                        <table class="table table-hover" style="border:1px gray" id="SkillTable">
                                                <thead>
                                                    <tr>
                                                        <th>List of Skills</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="skillList">
                                                
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
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
        <!-- Add Skills Modal -->
        <div class="modal fade" id="add-skills" role="dialog" style=" overflow-y:scroll;">
            <div class="modal-dialog" style="width:400px">
                <!-- Modal content-->
                <div class="modal-content" >
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
                                        <select class="form-control"  id="" data-parsley-required="true" name="skill" style="width: 100%;" required="required">
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
                        <button type="button" class="btn btn-primary pull-left" id="skill-save">Submit</button>
                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- Change Achievement Modal -->
        <div class="modal fade" id="change-achievement" role="dialog" style=" overflow-y:scroll;">
            <div class="modal-dialog" style="width:500px">
                {{$errors}}
                <!-- Modal content-->
                <div class="modal-content" >
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Achievement Settings</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="an-content-body">
                            <div class="row">
                                <div style="padding:10px">
                                     <button type="button" class="btn btn-primary pull-right"  data-toggle="modal" data-target="#add-achievement"><i class="glyphicon glyphicon-plus">Achievement</i></button>
                                </div>
                                <div class="col-md-offset-2">
                                    <div class="col-md-8">
                                        <!-- <p id="achievementChange"></p> -->
                                        <table class="table table-hover" style="border:1px gray">
                                                <thead>
                                                    <tr>
                                                        <th>List of Achievement</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="achievementChange">
                                                
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
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
        <!-- Add Achievement Modal -->
        <div class="modal fade" id="add-achievement" role="dialog" style=" overflow-y:scroll;">
            <div class="modal-dialog" style="width:500px">
                {{$errors}}
                <!-- Modal content-->
                <div class="modal-content" >
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Add Achievement</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="an-content-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="achievement" class="col-sm-2 control-label">Achivement:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" id="achievement" placeholder="Achievement">
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="description" class="col-sm-2 control-label">Description:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" name="description" class="form-control" id="description" placeholder="Description">
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="year_started" class="col-sm-2 control-label">Year Started:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="date" name="year_start" class="form-control" id="year_started" placeholder="Year Started">
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="year_end" class="col-sm-2 control-label">Year End:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="date" name="year_end" class="form-control" id="year_end" placeholder="Year End">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end .AN-COMPONENT-BODY -->
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-primary pull-left" id="achievement-save" >Submit</button> 
                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection

@section('custom_js')
  @include('pages.profile.script.profile-script')
@endsection