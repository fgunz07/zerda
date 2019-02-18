@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-offset-1">
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header">

								<form action="#" method="get" class="form">
									<div class="input-group">
									<input type="text" name="keyword" class="form-control" placeholder="Search...">
										<span class="input-group-btn">
											<button type="submit" name="search" id="search-dev" class="btn btn-flat primary"><i class="fa fa-search"></i>
											</button>
										</span>
									</div>

									<div class="form-group" style="margin: 5px 0 0 0;">
										{!! Form::select('skill', ['1' => 'all'], old('skill'), ['class' => 'form-control', 'id' => 'skill']) !!}
									</div>
								</form>
								<br>

								<h2 class="box-title">List of Availabe Developers</h2>
								
							</div>
						
							<div class="box-body" sytle="padding:20px">
								
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Firstname</th>
											<th>Lastname</th>
											<th>Last Name</th>
											<th text-align="right">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($users as $dev)	
										<tr data-toggle="collapse" data-target=".dev-info" class="accordion-toggle devs">
											<td>
												<input type="hidden" class="devID" value="{{$dev->id}}">
												<strong>{{$dev->last_name}}</strong>
											</td>
											<td><strong>{{$dev->first_name}}</strong></td>
											<td> <strong>{{$dev->middle_name}}</strong></td>
											<td>	
												<div class="pull-right">
													<a href="{{url('profile-view',$dev->id)}}" class="btn btn-primary btn-block viewProfile"><i class="glyphicon glyphicon-user "></i><b>View Profile</b></a>
												</div>	
											</td>
										</tr>
										<tr class=information>
											<td colspan="4" class="hiddentablerow">
												<div class="box-group  accordian-body collapse dev-info">
													<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
													<div class="panel box box-info">
														<div class="box-header with-border">
															<h4 class="box-title">
																<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
																	Additional Information
																</a>
															</h4>

															<div>
																<select class="star-rating">
																	@foreach($dev->child_user_rating as $rate)
																	<option value="$rate->rating">{{count($rate->parent_user_rating_desc) > 0 ? $rate->parent_user_rating_desc[0]->description : 'Not Set'}},</option>
																	@endforeach
																</select>
																
															</div>	
															
															<input type="hidden" class="devID" value="{{$dev->id}}">
														</div>
														<div id="collapseOne" class="panel-collapse collapse in">
															<div class="box-body">
																<strong><i class="glyphicon glyphicon-envelope margin-r-5"></i> Email Address</strong>

																<p class="text-muted">{{$dev->email}}</p>

																<hr>

																<strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
																<p class="text-muted">{{count($dev->child_user_location) > 0 ? $dev->child_user_location[0]->street : 'Not Set'}},{{count($dev->child_user_location) > 0 ? $dev->child_user_location[0]->brgy : 'Not Set'}},{{count($dev->child_user_location) > 0 ? $dev->child_user_location[0]->city : 'Not Set'}},{{count($dev->child_user_location) > 0 ? $dev->child_user_location[0]->province : 'Not Set'}},{{count($dev->child_user_location) > 0 ? $dev->child_user_location[0]->country : 'Not Set'}}</p>													
																
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
																@foreach($dev->child_user_specilization as $skill)
																<span class="label label-success">{{$skill->sklill_desc->description}}</span>
																@endforeach
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

																<p>
																	@foreach($dev->child_user_achievement as $achievement)
																	<span class="label label-success">{{$achievement->name}}</span>
																	@endforeach
																</p>

															</div>
														</div>
													</div>
												</div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<br>
							<br>
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