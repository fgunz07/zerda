@extends('layouts.app')

@section('content') 
    @foreach($users as $user)
        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <a href="{{ url('user/profile/'.$user->id) }}">
                    <div class="widget-user-header bg-aqua-active">
                        <h3 class="widget-user-username">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} </h3>
                        <h5 class="widget-user-desc">
                            <small class="label bg-yellow">{{ $user->getRoleNames()[0] }}</small>
                        </h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ is_null(auth()->user()->avatar_url) ? asset('images/user4-128x128.jpg') : asset(auth()->user()->avatar_url) }}" alt="User Avatar">
                    </div>
                </a>
                <div class="box-footer">
                    <div class="row">
                        @if($user->hasRole(['Senior Developer','Developer']))
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ count($user->skills) }}</h5>
                                    <span class="description-text">Skills</span>
                                </div>
                            <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        @endif
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ count($user->boards) }}</h5>
                                <span class="description-text">Projects</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        @if($user->hasRole(['Senior Developer', 'Developer']))
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35%</h5>
                                    <span class="description-text">Rating</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        @endif

                        @if($user->hasRole('Client'))
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35%</h5>
                                    <span class="description-text">Pay Rating</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        @endif
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.widget-user -->
        </div>
    @endforeach
@endsection