@extends('layouts.app')

@section('custom_css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
	<div class="row">

		<div class="col-md-12">
			<div class="col-md-4">
				<div class="box box-primary">
					<div class="box-body box-profile" id="profile">

						<label for="select-file" class="profile-user-img img-responsive img-circle" style="cursor: pointer;">
							<img class="profile-user-img img-responsive img-circle" id="profile-photo" src="{{ is_null(auth()->user()->avatar_url) ? asset('images/user4-128x128.jpg') : asset(auth()->user()->avatar_url) }}" alt="User profile picture">

							<input type="file" name="img" style="display: none;" id="select-file">
						</label>

						<h4 class="profile-username text-center">{{ auth()->user()->first_name }} {{ auth()->user()->middle_name }} {{ auth()->user()->last_name }}</h4>
					</div>
				</div>

				<div class="box box-primary">

					<div class="box-header" id="">
						<strong>
							<i class="glyphicon glyphicon-user"></i>
							Current Role
						</strong>
						@if(count(auth()->user()->roles) < 1)
							<a href="" class="editInlineSkills" data-toggle="modal" data-target="#add-role">
								<i class="glyphicon glyphicon-pencil"></i>
							</a>
						@endif

						@foreach(auth()->user()->roles as $role)
						&nbsp;
						<span class="label label-primary">
							{{ $role->name }}
						</span>

						@endforeach
					</div>

				</div>

				@hasanyrole('Senior Developer|Developer')
					<div class="box box-primary">

						<div class="box-header" id="">

							<div id="skills">
								<strong>
									<i class="glyphicon glyphicon-list"></i>&nbsp;Skills
								</strong>
								<a href="" class="editInlineSkills" data-toggle="modal" data-target="#add-skills">
									<i class="glyphicon glyphicon-pencil"></i>
								</a>
							</div>

						</div>
						
						<div class="box-body" id="skills-view">
							@foreach(auth()->user()->skills as $skill)
								<span class="{{ $skill->class }}">{{ $skill->name }}</span>
							@endforeach
						</div>

					</div>
				@endhasrole
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3>53<sup style="font-size: 20px">%</sup></h3>

						<p>Pay Rate</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
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


						<span>
							<strong>Tertiary:</strong>
							<p class="text-muted" id="tertiary">
								{{auth()->user()->primary_edication_full_details}}
							</p>
						</span>

						<span>
							<strong>Secondary:</strong>
							<p class="text-muted" id="secondary">
								{{auth()->user()->secondary_edication_full_details}}
							</p>
						</span>
						<span>
							<strong>Primary:</strong>
							<p class="text-muted" id="primary">
								{{auth()->user()->teriary_edication_full_details}}
							</p>
						</span>

						<hr>

						<div id="location">
							<strong>
								<i class="fa fa-map-marker margin-r-5"></i>Location
							</strong>
							<a href="" class="editInlineLocation" data-toggle="modal" data-target="#change-location"><i class="glyphicon glyphicon-pencil"></i></a>
						</div>

						<p class="text-muted" id="location-ni">
							{{auth()->user()->address}}
						</p>

						<hr>

						<div id="">
							<strong>
								<i class="fa fa-pencil margin-r-5"></i>
								@hasanyrole('Senior Developer|Developer')
									Portfolio
								@endhasrole

								@hasrole('Client')
									Company
								@endhasrole
							</strong>
							<a href="" class="editInlineSkills" data-toggle="modal" data-target="#portfolio">
								<i class="glyphicon glyphicon-pencil"></i>
							</a>

							<div>
								<a href="{{ auth()->user()->portfolio }}" target="_blank">{{ auth()->user()->portfolio }}</a>
							</div>
						</div>

						<hr>

						@hasanyrole('Senior Developer|Developer')

							<div id="">
								<strong>
									<i class="fa fa-trophy margin-r-5"></i>Achievements
								</strong>
								<a href="" class="editInlineAchievement" data-toggle="modal" data-target="#achievement">
									<i class="glyphicon glyphicon-plus"></i>
								</a>

								<div>

									@foreach(auth()->user()->achievements as $ach)

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
														<a href="#" id="achievement-{{ $ach->id }}" class="text-muted edit-achievement" data-toggle="modal" data-target="#achievement-edit">
															<i class="glyphicon glyphicon-pencil"></i>
														</a>
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

						@endhasrole

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
													<img  class="profile-user-img img-responsive img-circle "  src="{{ asset('images/user4-128x128.jpg') }}" alt="User profile picture"/>
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

									<label for="primary" class="col-sm-2 control-label">Primary:</label>

									<div class="col-sm-10">
										{!!Form::text('primary',old('primary', auth()->user()->primary_edication_full_details),['class'=>'form-control','id'=>'primary'])!!}
									</div>

									<br><br>

									<label for="secondary" class="col-sm-2 control-label">Secondary:</label>

									<div class="col-sm-10">
										{!!Form::text('secondary',old('secondary', auth()->user()->secondary_edication_full_details),['class'=>'form-control','id'=>'secondary'])!!}
									</div>

									<br><br>

									<label for="tertiary" class="col-sm-2 control-label">Tertiary:</label>

									<div class="col-sm-10">
										{!!Form::text('tertiary',old('tertiary', auth()->user()->teriary_edication_full_details),['class'=>'form-control','id'=>'tertiary'])!!}
									</div>

								</div>
							</div> <!-- end .AN-COMPONENT-BODY -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary btn-flat pull-left" id="educ-save">Save</button>
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
										{!!Form::text('street',old('street', auth()->user()->street),['class'=>'form-control','id'=>'street'])!!}
									</div>

									<br><br>

									<label for="brgy" class="col-sm-2 control-label">Barangay:</label>

									<div class="col-sm-10">
										{!!Form::text('brgy',old('brgy', auth()->user()->brgy),['class'=>'form-control','id'=>'brgy'])!!}
									</div>

									<br><br>

									<label for="city" class="col-sm-2 control-label">City:</label>

									<div class="col-sm-10">
										{!!Form::text('city',old('city', auth()->user()->city),['class'=>'form-control','id'=>'city'])!!}
									</div>

									<br><br>

									<label for="province" class="col-sm-2 control-label">Province:</label>

									<div class="col-sm-10">
										{!!Form::text('province',old('province', auth()->user()->province),['class'=>'form-control','id'=>'province'])!!}
									</div>

									<br><br>

									<label for="country" class="col-sm-2 control-label">Country:</label>

									<div class="col-sm-10">
										{!!Form::text('country',old('country', auth()->user()->country),['class'=>'form-control','id'=>'country'])!!}
									</div>

								</div>
							</div> <!-- end .AN-COMPONENT-BODY -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary btn-flat pull-left" id="location-save" >Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div>
			<!-- portfolio Modal -->
			<div class="modal fade" id="portfolio" role="dialog" style=" overflow-y:scroll;">
				<div class="modal-dialog" style="width:500px">
					<!-- Modal content-->
					<div class="modal-content" >

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><b>Portfolios</b></h4>
						</div>
						<div class="modal-body">
							<div class="an-content-body">
								<div class="form-group">
									<div class="row">

										<div class="col-md-3">
											<label>
												URL:
											</label>
										</div>
										<div class="col-md-9">
											{!!Form::text('portfolio_url', old('portfolio_url', auth()->user()->portfolio), ['class' => 'form-control'])!!}
										</div>

									</div>
								</div>
							</div> <!-- end .AN-COMPONENT-BODY -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary btn-flat pull-left" id="portfolio-save">Save</button>
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
										{!!Form::select('skills[]',$skills->pluck('name', 'id') , old('skills', auth()->user()->skills), ['class' => 'form-control', 'id' => 'select-skills' , 'multiple' => 'multiple' , 'style' => 'width: 100%'])!!}
									</div>
								</div>
							</div> <!-- end .AN-COMPONENT-BODY -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary btn-flat pull-left" id="skill-save">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div>
			<!-- Select for the first time Modal -->
			<div class="modal fade" id="add-role" role="dialog" style=" overflow-y:scroll;">
				<div class="modal-dialog" style="width:400px">
					<!-- Modal content-->
					<div class="modal-content" >
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><b>Select Role</b></h4>
						</div>
						<div class="modal-body">
							<div class="an-content-body">
								<div class="row">
									<label for="description" class="col-sm-2 control-label">Roles:</label>

									<div class="col-sm-10">
										{!!Form::select('role', $roles->pluck('name', 'id'), old('skills', 0), ['class' => 'form-control'])!!}
									</div>
								</div>
							</div> <!-- end .AN-COMPONENT-BODY -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary btn-flat pull-left" id="role-save">Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div>
			<!-- Add Achievement Modal -->
			<div class="modal fade" id="achievement" role="dialog" style=" overflow-y:scroll;">
				<div class="modal-dialog" style="width:500px">
					<!-- Modal content-->
					<div class="modal-content" >

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><b>Achievement</b></h4>
						</div>
						<div class="modal-body">
							<div class="an-content-body">
								<div class="row">
									<div class="form-group">
										<div class="col-sm-3">
											<label for="" class="col-sm-2 control-label">Achivement:</label>
										</div>
										<div class="col-sm-9">
											{!!Form::text('achievement_name', old('achievement_name'), ['class' => 'form-control'])!!}
										</div>
									</div>
									<br><br>
									<div class="form-group">
										<div class="col-sm-3">
											<label for="year_started" class="col-sm-2 control-label">Started:</label>
										</div>
										<div class="col-sm-9">
											{!!Form::text('year_start', old('year_start'), ['class' => 'form-control date', 'id' => 'year_started'])!!}
										</div>
									</div>
									<br><br>
									<div class="form-group">
										<div class="col-sm-3">
											<label for="year_end" class="col-sm-2 control-label">End:</label>
										</div>
										<div class="col-sm-9">
											{!!Form::text('year_end', old('year_end'), ['class' => 'form-control date', 'id' => 'year_end'])!!}
										</div>
									</div>
									<br><br>
									<div class="form-group">
										<div class="col-sm-3">
											<label for="description" class="col-sm-2 control-label">Description:</label>
										</div>
										<div class="col-sm-9">
											<textarea name="description" class="form-control" id="description" rows="10"></textarea>
										</div>
									</div>
								</div>
							</div> <!-- end .AN-COMPONENT-BODY -->
						</div>
						<div class="modal-footer">

							<button type="button" class="btn btn-primary btn-flat pull-left" id="achievement-save" >Save</button> 
						</div>
					</div>
				</div>
			</div>
		</div>

		<div>
			<!-- Add Achievement Modal -->
			<div class="modal fade" id="achievement-edit" role="dialog" style=" overflow-y:scroll;">
				<div class="modal-dialog" style="width:500px">
					<!-- Modal content-->
					<div class="modal-content" >

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><b>Achievement</b></h4>
						</div>
						<div class="modal-body">
							<div class="an-content-body">
								<div class="row">
									<div class="form-group">
										<div class="col-sm-3">
											<label for="" class="col-sm-2 control-label">Achivement:</label>
										</div>
										<div class="col-sm-9">
											{!!Form::text('achievement_name_edit', old('achievement_name_edit'), ['class' => 'form-control'])!!}
										</div>
									</div>
									<br><br>
									<div class="form-group">
										<div class="col-sm-3">
											<label for="year_started" class="col-sm-2 control-label">Started:</label>
										</div>
										<div class="col-sm-9">
											{!!Form::text('year_start_edit', old('year_start_edit'), ['class' => 'form-control date', 'id' => 'year_started'])!!}
										</div>
									</div>
									<br><br>
									<div class="form-group">
										<div class="col-sm-3">
											<label for="year_end" class="col-sm-2 control-label">End:</label>
										</div>
										<div class="col-sm-9">
											{!!Form::text('year_end_edit', old('year_end_edit'), ['class' => 'form-control date', 'id' => 'year_end'])!!}
										</div>
									</div>
									<br><br>
									<div class="form-group">
										<div class="col-sm-3">
											<label for="description" class="col-sm-2 control-label">Description:</label>
										</div>
										<div class="col-sm-9">
											<textarea name="description_edit" class="form-control" id="description" rows="10"></textarea>
										</div>
									</div>
								</div>
							</div> <!-- end .AN-COMPONENT-BODY -->
						</div>
						<div class="modal-footer">

							<button type="button" class="btn btn-primary btn-flat pull-left" id="achievement-save-edit" >Save</button> 
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
@endsection

@section('custom_js')
	<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/http.js') }}"></script>
	<script type="text/javascript">
		$('.date').datepicker({
			format: 'yyyy-mm-dd'
		})
		$('.date').datepicker({
			format: 'yyyy-mm-dd'
		})
		$('#select-skills').select2()

		$('#skill-save').on('click', function(e) {

			const options = {
				url 		: '/user/skill',
				method		: 'POST',
				data 		: {
					skills 	: $('select[name="skills[]"]').val()
				}
			}

			function renderSkills(arr) {

				$('#skills-view').empty()

				arr.forEach(item => {

					let HTMLElement = `
						<span class="${item.class}">${item.name}</span>
					`;

					$('#skills-view').append(HTMLElement)

				});

			}

			http(options)
				.done(res => renderSkills(res.message))
				.fail(err => console.log(err))

		})

		$('#role-save').on('click', function(e) {

			const options = {
				url 	: '/user/role',
				method	: 'POST',
				data 	: {
					role: $('select[name=role]').val()
				}
			}

			http(options)
				.done(res => window.location.reload())
				.fail(err => swal('Error', err.message, 'error'))

		})

		$('#educ-save').on('click', function(e) {

			const options = {
				url 	: '/user/education',
				method 	: 'POST',
				data 	: {
					primary 	: $('input[name=primary]').val(),
					secondary 	: $('input[name=secondary]').val(),
					tertiary 	: $('input[name=tertiary]').val()
				}
			}

			http(options)
				.done(res => window.location.reload())
				.fail(err => console.log(err))

		})

		$('#location-save').on('click', function(e) {

			const options = {
				url 	: '/user/location',
				method 	: 'POST',
				data 	: {
					street 	: $('input[name=street]').val(),
					brgy  	: $('input[name=brgy]').val(),
					city  	: $('input[name=city]').val(),
					province: $('input[name=province]').val(),
					country : $('input[name=country]').val()
				}
			}

			http(options)
				.done(res => window.location.reload())
				.fail(err => swal('Err', err.message , 'error'));

		})

		$('#portfolio-save').on('click', function(e) {

			const options = {
				url 	: '/user/portfolio',
				method 	: 'POST',
				data 	: {
					portfolio: $('input[name=portfolio_url]').val()
				}
			}

			http(options)
				.done(res => window.location.reload())
				.fail(err => swal('Error', err.message , 'error'))

		})

		$('#achievement-save').on('click', function(e) {

			const options = {
				url 	: '/user/achievement',
				method 	: 'POST',
				data 	: {
					name 	: $('input[name=achievement_name]').val(),
					start   : $('input[name=year_start]').val(),
					end 	: $('input[name=year_end]').val(),
					description: $('textarea[name=description]').val()
				}
			}

			http(options)
				.done(res => window.location.reload())
				.fail(err => console.log(err))

		})

		let id = null;

		$('.edit-achievement').on('click', function(e) {

			id = this.id.split('-').pop()

			const options = {
				url 	: `/user/achievement/${id}`,
				method 	: 'GET'
			}

			function initValues(object) {

				$('input[name=achievement_name_edit]')	.val('')
				$('input[name=year_start_edit]')		.val('')
				$('input[name=year_end_edit]')			.val('')
				$('textarea[name=descriptio_edit]')		.val('')

				$('input[name=achievement_name_edit]')	.val(object.name)
				$('input[name=year_start_edit]')		.val(object.year_start)
				$('input[name=year_end_edit]')			.val(object.year_end)
				$('textarea[name=description_edit]')	.val(object.description)
			}

			http(options)
				.done(res => initValues(res))
				.fail(err => swal('Error', err.message, 'error'));

		})

		$('#achievement-save-edit').on('click', function(e) {

			const options = {
				url 	: `/user/achievement/${id}`,
				method 	: 'PUT',
				data 	: {
					name 	: $('input[name=achievement_name_edit]').val(),
					start   : $('input[name=year_start_edit]').val(),
					end 	: $('input[name=year_end_edit]').val(),
					description: $('textarea[name=description_edit]').val()
				}
			}

			http(options)
				.done(res => window.location.reload())
				.fail(err => swal('Error ', err.message , 'error'))

		})

		$('input[name=img]').on('change' , function(e) {

			function callBack(object) {

				window.location.reload()

			}

			const form = new FormData()

			form.append('img', this.files[0]);

			const options = {
				url 	: '/user/profile',
				method 	: 'POST',
				processData: false,
				contentType: false,
				data 	: form
			}

			http(options)
				.done(res => callBack(res))
				.fail(err => console.log(err))

		})
	</script>
@endsection