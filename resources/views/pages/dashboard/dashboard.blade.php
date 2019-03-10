@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
      @if(auth()->user()->hasRole('Client'))
        <!-- The time line -->
        <ul class="timeline">
          <!-- timeline time label -->
          <li class="time-label">
                <span class="bg-red">
                  {{ \Carbon\Carbon::now()->format('D d Y') }}
                </span>
          </li>
          <!-- /.timeline-label -->
          <!-- timeline item -->
          <li>
            <i class="fa fa-users bg-blue"></i>

            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::now()->format('H:m:s') }}</span>

              <h3 class="timeline-header"><a href="#">Recommended Developers</a></h3>

              <div class="timeline-body">
                <div class="row">

                  <?php $count = 0; ?>
                  
                      @foreach($users as $user)
                          
                              <div class="col-md-4">
                                  <div class="box box-widget widget-user-2">
                                      <!-- Add the bg color to the header using any of the bg-* classes -->
                                      <div class="widget-user-header bg-yellow">
                                      <div class="widget-user-image">
                                          <img class="img-circle" src="{{ is_null($user->avatar_url) ? asset('images/user4-128x128.jpg') : asset($user->avatar_url) }}" alt="User Avatar">
                                      </div>
                                      <!-- /.widget-user-image -->
                                      <h3 class="widget-user-username">
                                          <a href="{{ url('user/profile/'.$user->id) }}" style="color: white;">
                                            {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} 
                                          </a>
                                      </h3>
                                      <h5 class="widget-user-desc">{{ $user->getRoleNames()[0] }}</h5>
                                      <span class="text-muted">Rank: <small class='label label-default'>{{ $count += 1 }}</small></span>
                                      </div>
                                      <div class="box-footer no-padding">
                                      <ul class="nav nav-stacked">
                                          <li><a href="#">Projects <span class="pull-right badge bg-blue">{{ count($user->boards) }}</span></a></li>
                                          <li>
                                            <a href="#">
                                              Tasks Completed 
                                              <span class="pull-right badge bg-aqua">
                                                <?php $boardCompleted = 0; ?>

                                                @foreach($user->boards as $board)
                                                  <?php ($board->completed == 1) ? $boardCompleted += 1 : 0; ?>
                                                @endforeach

                                                {{ $boardCompleted }}
                                              </span>
                                            </a>
                                          </li>
                                          <li><a href="#"> Skills<span class="pull-right badge bg-green">{{ count($user->skills) }}</span></a></li>
                                          <li><a href="#">Portfolio </a></li>
                                      </ul>
                                      </div>
                                  </div>
                              </div>

                      @endforeach

                  </div>
              </div>
              <div class="timeline-footer">
                {{--  <a class="btn btn-primary btn-xs">Read more</a>
                <a class="btn btn-danger btn-xs">Delete</a>  --}}
              </div>
            </div>
          </li>
          <!-- END timeline item -->
          
        </ul>
      @else
        <div class="row">
          <div class="col-md-4">
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{ (auth()->user()->total_rate > 0 && auth()->user()->number_rate > 0) ? round((auth()->user()->total_rate / (auth()->user()->number_rate * 10)) * 100) : 0 }}%</h3>

                <p>Rating</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>{{ count(auth()->user()->boards) }}</h3>

                <p>Projects</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-folder"></i>
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>
    <!-- /.col -->
</div>
@endsection