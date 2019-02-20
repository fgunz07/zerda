@extends('layouts.app')
@section('content')
<div class="row">

    <div class="col-md-12">
         
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body box-profile">

                     <img class="profile-user-img img-responsive img-circle" id="profile-photo" src="{{ is_null($user->avatar_url) ? asset('images/user4-128x128.jpg') : asset($user->avatar_url) }}" alt="User profile picture">
                   
                    <h3 class="profile-username text-center" id="nameDev">{{$user->last_name}},{{$user->first_name}},{{$user->middle_name}}</h3>
                    <input type="hidden" value="{{$user->id}}" id="devID">
                    
                    <div class="pull-left">
                        <select class="star-rating" id="dev-rate" name="rating"  disabled>
                            <option value="">Select a rating</option>
                            @foreach($ratedesc as $rate)
                            <option value="{{$rate->id}}">{{$rate->description}}</option>
                            @endforeach
                        </select>
                    </div>
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
                    
                   
                    <span><strong>Tertiary:</strong> <p class="text-muted" id="tertiaryDev"></p>{{$user->primary_edication_full_details}}</span>
                    <span><strong>Secondary:</strong> <p class="text-muted" id="secondaryDev">{{$user->secondary_edication_full_details}}</p></span>
                    <span><strong>Primary:</strong> <p class="text-muted" id="primaryDev"></p>{{$user->teriary_edication_full_details}}</span>

                    <hr>

                    <div>
                        <strong><i class="fa fa-map-marker margin-r-5"></i>Location</strong>
                    </div>

                    <p class="text-muted" id="locationDev">{{$user->street ? $user->street : 'Not Set'}},{{$user->brgy? $user->brgy : 'Not Set'}},{{$user->city ? $user->city : 'Not Set'}},{{$user->province ? $user->province : 'Not Set'}},{{$user->country ? $user->country : 'Not Set'}}</p>

                    <hr>

                    <div>
                        <strong><i class="fa fa-pencil margin-r-5"></i>Skills</strong>
                    </div>

                    @foreach($user->skills as $skill)
                    <p>
                        <span class="label label-success">{{$skill->sklill_desc->description}}</span>
                    </p>
                    @endforeach

                    <hr>

                    <div>
                        <strong><i class="fa fa-trophy margin-r-5"></i>Achievemet</strong>
                    </div>

                    
                        <p id="achievementListDev">
                            @foreach($user->achievements as $achievement)
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
        
    </div>

    <div>

</div>


@endsection

@section('custom_js')
    @include('pages.dashboard.script.devlist-script')
@endsection