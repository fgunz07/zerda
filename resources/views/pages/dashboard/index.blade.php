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
														{{$dev->first_name}}, {{$dev->middle_name}}, {{$dev->last_name}}
													</a>
												</h4>
											</div>
											<div id="collapseOne" class="panel-collapse collapse in">
												<div class="box-body">
													Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
													wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
													eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
													assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
													nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
													farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
													labore sustainable VHS.
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
													Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
													wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
													eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
													assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
													nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
													farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
													labore sustainable VHS.
												</div>
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
													Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
													wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
													eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
													assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
													nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
													farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
													labore sustainable VHS.
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
			</div>
	</div>
@endsection