@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
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
          <i class="fa fa-envelope bg-blue"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::now()->diffInHours() }}</span>

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
                                        <img class="img-circle" src="{{ $user->avatar_url }}" alt="User Avatar">
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <h3 class="widget-user-username">
                                        {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} 
                                    </h3>
                                    <h5 class="widget-user-desc">{{ $user->getRoleNames()[0] }}</h5>
                                    <span class="text-muted">Rank: <small class='label label-default'>{{ $count += 1 }}</small></span>
                                    </div>
                                    <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li><a href="#">Projects <span class="pull-right badge bg-blue">{{ count($user->boards) }}</span></a></li>
                                        <li><a href="#">Tasks Completed <span class="pull-right badge bg-aqua">0</span></a></li>
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
              <a class="btn btn-primary btn-xs">Read more</a>
              <a class="btn btn-danger btn-xs">Delete</a>
            </div>
          </div>
        </li>
        <!-- END timeline item -->
        <!-- timeline item -->
        <li>
          <i class="fa fa-user bg-aqua"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

            <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
          </div>
        </li>
        <!-- END timeline item -->
        <!-- timeline item -->
        <li>
          <i class="fa fa-comments bg-yellow"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

            <div class="timeline-body">
              Take me to your leader!
              Switzerland is small and neutral!
              We are more like Germany, ambitious and misunderstood!
            </div>
            <div class="timeline-footer">
              <a class="btn btn-warning btn-flat btn-xs">View comment</a>
            </div>
          </div>
        </li>
        <!-- END timeline item -->
        <!-- timeline time label -->
        <li class="time-label">
              <span class="bg-green">
                3 Jan. 2014
              </span>
        </li>
        <!-- /.timeline-label -->
        <!-- timeline item -->
        <li>
          <i class="fa fa-camera bg-purple"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

            <div class="timeline-body">
              <img src="http://placehold.it/150x100" alt="..." class="margin">
              <img src="http://placehold.it/150x100" alt="..." class="margin">
              <img src="http://placehold.it/150x100" alt="..." class="margin">
              <img src="http://placehold.it/150x100" alt="..." class="margin">
            </div>
          </div>
        </li>
        <!-- END timeline item -->
      </ul>
    </div>
    <!-- /.col -->
</div>
@endsection