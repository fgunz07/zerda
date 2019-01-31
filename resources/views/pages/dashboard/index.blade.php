@extends('layouts.app')

@section('content')
	<div class="row">
		  <div class="col-md-4">
	          	 <div class="row">
			        <div class="col-md-12">

			          <div class="box box-info">
			            <div class="box-header">
			              <h3 class="box-title">Category</h3>
			            </div>
			            <div class="box-body">
			              <div class="form-group">
											<ul>
												@foreach($skills as $skill)
													<li><span class="label label-info">{{$skill->description}}</span></li>
												@endforeach
											</ul>
			              </div>
			            </div>
			            <!-- /.box-body -->
			          </div>
			          <!-- /.box -->
			        </div>
			      </div>
	      </div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header">
									<h2 class="box-title">List of Availabe Developers</h2>
								</div>
								<div class="box-body">
									@foreach($users as $dev)
									<div class="box-group" id="accordion">
										<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
										<div class="panel box box-info">
											<div class="box-header with-border">
												<h4 class="box-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
														{{$dev->last_name}},{{$dev->first_name}}, {{$dev->middle_name}}.
													</a>
												</h4>
											</div>
											<div id="collapseOne" class="panel-collapse collapse in">
												<div class="box-body">
													<strong><i class="fa fa-book margin-r-5"></i> Education</strong>

													<p class="text-muted">
													B.S. in Computer Science from the University of Tennessee at Knoxville
													</p>

													<hr>

													<strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

													<p class="text-muted">Malibu, California</p>

													
												</div>
											</div>
										</div>
										<div class="panel box box-danger">
											<div class="box-header with-border">
												<h4 class="box-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
													Skills
													</a>
												</h4>
											</div>
											<div id="collapseTwo" class="panel-collapse collapse">
												<div class="box-body">

												<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

												<p>
												<span class="label label-danger">UI Design</span>
												<span class="label label-success">Coding</span>
												<span class="label label-info">Javascript</span>
												<span class="label label-warning">PHP</span>
												<span class="label label-primary">Node.js</span>
												</p>
											</div>
										</div>
										<div class="panel box box-success">
											<div class="box-header with-border">
												<h4 class="box-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
														Achievements
													</a>
												</h4>
											</div>
											<div id="collapseThree" class="panel-collapse collapse">
												<div class="box-body">

													<strong><i class="fa fa-file-text-o margin-r-5"></i> Achievements</strong>

													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>

												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								<div class="box-footer">
									<div class="pull-left">
										<select class="star-rating" id="star-rating">
											<option value="">rate</option>
											<option value="5">Excellent</option>
											<option value="4">Very Good</option>
											<option value="3">Average</option>
											<option value="2">Poor</option>
											<option value="1">Terrible</option>
										</select>
									</div>	
									<div class="pull-right">
										<a href="#" class="btn btn-primary btn-block"><b>Hire Me</b></a>
									</div>	
								</div>
							</div>
						</div>
					</div>
			</div>
	</div>
@endsection

@section('custom_js')
  @include('pages.dashboard.script.devlist-script')
@endsection