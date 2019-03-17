@extends('layouts.app')
@section('custom_css')
    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection
@section('content')
<div class="row">

        <div class="col-md-12">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body box-profile" id="profile">

                        <label for="select-file" class="profile-user-img img-responsive img-circle" style="cursor: pointer;">
                            <img class="profile-user-img img-responsive img-circle" id="profile-photo" src="{{ is_null($user->avatar_url) ? asset('images/user4-128x128.jpg') : asset($user->avatar_url) }}" alt="User profile picture">

                            <input type="file" name="img" style="display: none;" id="select-file">
                        </label>

                        <h4 class="profile-username text-center">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</h4>
                    </div>
                </div>

                <div class="box box-primary">

                    <div class="box-header" id="">
                        <strong>
                            <i class="glyphicon glyphicon-user"></i>
                            Current Role
                        </strong>
                        &nbsp;
                        <span class="label label-primary">
                            {{ $user->getRoleNames()[0] }}
                        </span>
                    </div>

                </div>

                @if($user->hasRole(['Senior Developer','Developer']))
                    <div class="box box-primary">

                        <div class="box-header" id="">

                            <div id="skills">
                                <strong>
                                    <i class="glyphicon glyphicon-list"></i>&nbsp;Skills
                                </strong>
                            </div>

                        </div>
                        
                        <div class="box-body" id="skills-view">
                            @foreach($user->skills as $skill)
                                <span class="{{ $skill->class }}">{{ $skill->name }}</span>
                            @endforeach
                        </div>

                    </div>
                @endif
                @if($user->hasRole('Client'))
                    <!-- small box -->
                    <!-- <div class="small-box bg-green">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Paying Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div> -->
                @else
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                          <h3>{{ ($user->rate > 0 ? $user->rate : 0  }}%</h3>

                          <p>Rating</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                      </div>
                @endif

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
                        </div>


                        <span>
                            <strong>Tertiary:</strong>
                            <p class="text-muted" id="tertiary">
                                {{$user->primary_edication_full_details}}
                            </p>
                        </span>

                        <span>
                            <strong>Secondary:</strong>
                            <p class="text-muted" id="secondary">
                                {{$user->secondary_edication_full_details}}
                            </p>
                        </span>
                        <span>
                            <strong>Primary:</strong>
                            <p class="text-muted" id="primary">
                                {{$user->teriary_edication_full_details}}
                            </p>
                        </span>

                        <hr>

                        <div id="location">
                            <strong>
                                <i class="fa fa-map-marker margin-r-5"></i>Location
                            </strong>
                        </div>

                        <p class="text-muted" id="location-ni">
                            {{$user->address}}
                        </p>

                        <hr>

                        <div id="">
                            <strong>
                                <i class="fa fa-pencil margin-r-5"></i>
                                @if($user->hasRole(['Senior Developer','Developer']))
                                    Portfolio
                                @endif

                                @if($user->hasRole('Client'))
                                    Company
                                @endif
                            </strong>

                            <div>
                                <a href="{{ auth()->user()->portfolio }}" target="_blank">{{ $user->portfolio }}</a>
                            </div>
                        </div>

                        <hr>

                        @if($user->hasRole(['Senior Developer','Developer']))

                            <div id="">
                                <strong>
                                    <i class="fa fa-trophy margin-r-5"></i>Achievements
                                </strong>

                                <div>

                                    @foreach($user->achievements as $ach)

                                    <div class="panel box box-success">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree-{{$ach->id}}" class="collapsed" aria-expanded="false">
                                                    {{ $ach->name }}
                                                </a>

                                                <div>
                                                    <small class="text-muted">
                                                        from {{ $ach->year_start }} to {{ $ach->year_end }}
                                                        &nbsp;
                                                    </small>
                                                </div>
                                            </h4>
                                        </div>
                                        <div id="collapseThree-{{$ach->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                            <div class="box-body">
                                                {{ $ach->description }}
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach

                                </div>
                            </div>

                            <hr>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($user->hasRole(['Senior Developer','Developer']) && auth()->user()->hasRole('Client'))
        <div style="position: absolute;bottom: 10%;right: 3%;">
            <button type="button" class="btn bg-purple margin toggle-rate" data-toggle="modal" data-target="#modal-rate"><i class="fa fa-star"></i> Rate</button>
        </div>

        <div class="modal fade in" id="modal-rate">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Rate</h4>
              </div>
              <div class="modal-body">
                <input type="text" class="js-range-slider" name="rate_value" value="" />
                <input type="hidden" name="target_user_id" value="{{ $user->id }}">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" id="save-rate">Save</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    @endif

@endsection

@section('custom_script')
    <!--Plugin JavaScript file-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script src="{{ asset('js/http.js') }}"></script>

    @if($user->hasRole(['Senior Developer','Developer']) && auth()->user()->hasRole('Client'))
        <script type="text/javascript">
            'use strict';

            $(".js-range-slider").ionRangeSlider({
                type: "single",
                min: 1,
                max: 10,
                from: 1
            });

            document.querySelector('#save-rate')
            .addEventListener('click', function(e) {
                let id = document.querySelector('input[name=target_user_id]').value

                let options = {
                    url     : `/user/${id}/rate`,
                    method  : 'PUT',
                    data    : {
                        rate: document.querySelector('input[name=rate_value]').value
                    }  
                }

                http(options)
                .done(function(res) {
                    swal('Success', 'Rate success.', 'success')

                    setTimeout(function() {
                        window.location.reload()
                    }, 1000)
                })
                .fail(function(err) {
                    swal('Error', e.responseJSON.message, 'error')
                })
            })
        </script>
    @endif
@endsection
