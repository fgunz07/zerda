@extends('layouts.app')
@section('content')
<div class="row">

    <div class="col-md-12">
        @foreach($users as $user)
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body box-profile">

                     <img class="profile-user-img img-responsive img-circle " src="/uploads/avatars/{{ $user->avatar }}" alt="User profile picture">
                   
                    <h3 class="profile-username text-center" id="nameDev">{{$user->last_name}},{{$user->first_name}},{{$user->middle_name}}</h3>
                   
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

                    <div>
                        <strong><i class="fa fa-book margin-r-5"></i>Education</strong>
                    </div>
                    
                   
                    <span><strong>Tertiary:</strong> <p class="text-muted" id="tertiaryDev"></p>{{$user->child_user_education[0]->tertiary}}</span>
                    <span><strong>Secondary:</strong> <p class="text-muted" id="secondaryDev">{{$user->child_user_education[0]->secondary}}</p></span>
                    <span><strong>Primary:</strong> <p class="text-muted" id="primaryDev"></p>{{$user->child_user_education[0]->primary}}</span>

                    <hr>

                    <div>
                        <strong><i class="fa fa-map-marker margin-r-5"></i>Location</strong>
                    </div>

                    <p class="text-muted" id="locationDev">{{$user->child_user_location[0]->street}},{{$user->child_user_location[0]->brgy}},{{$user->child_user_location[0]->city}},{{$user->child_user_location[0]->province}},{{$user->child_user_location[0]->country}}</p>

                    <hr>

                    <div>
                        <strong><i class="fa fa-pencil margin-r-5"></i>Skills</strong>
                    </div>

                    <p>
                        @foreach($user->child_user_specilization as $skill)
                        <span class="label label-success">{{$skill->sklill_desc->description}}</span>
                        @endforeach
                    </p>

                    <hr>

                    <div>
                        <strong><i class="fa fa-trophy margin-r-5"></i>Achievemet</strong>
                    </div>

                    
                        <p id="achievementListDev">
                            @foreach($user->child_user_achievement as $achievement)
                            <span class="label label-success">{{$achievement->name}}</span>
                            @endforeach
                        </p>
                  
                    <hr>
                    <div class="pull-right">
                        <a href="{{url('dashboard')}}" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-arrow-left "></i><b>Back</b></a>
                    </div>
                </div>
                
            </div>
	    </div>
        @endforeach
    </div>

    <div>

</div>


@endsection

@section('custom_js')
  @include('pages.profile.script.profile-script')
@endsection