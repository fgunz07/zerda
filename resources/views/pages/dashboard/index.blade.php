@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-offset-1">
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header">
								<h4>Category By Skill</h4>
								<div class="form-group" style="margin: 5px 0 0 0;">
										{!! Form::select('skillsList', $skillsList->pluck('name', 'id'), old('skillsList'), ['class' => 'form-control', 'id' => 'skillsList']) !!}
									</div>
								<br>

								<h2 class="box-title">List of Availabe Developers</h2>
								
							</div>
						
							<div class="box-body" sytle="padding:20px">
								
								<table class="table table-hover" id="devlist">
									<thead style="background-color:#7647ed; color:white">
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
												<div>
												<strong style="color:red">Rate:{{isset($dev->ratings_average) ? $dev->ratings_average : '0'}}</strong>
												</div>
											</td>
											<td><strong>{{$dev->first_name}}</strong></td>
											<td> <strong>{{$dev->middle_name}}</strong></td>
											<td>	
												<div class="pull-right">
													<a href="{{url('profile-view',$dev->id)}}" class="btn btn-primary btn-block viewProfile"><i class="glyphicon glyphicon-user "></i><b>View Profile</b></a>
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