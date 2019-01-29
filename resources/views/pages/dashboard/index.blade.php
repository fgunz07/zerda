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
			                	<li><span class="label label-danger">UI Design</span></li>
				                <li><span class="label label-danger">UI Design</span></li>
				                <li><span class="label label-success">Coding</span></li>
				                <li><span class="label label-info">Javascript</span></li>
				                <li><span class="label label-warning">PHP</span></li>
				                <li><span class="label label-primary">Node.js</span></li>
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

		          <div class="box box-success">
		            <div class="box-header">
		              <h2 class="box-title">List of Availabe Developers</h2>
		            </div>
		            <div class="box-body" id="devlist">
		               @foreach($users as $dev)
	               		<div class="form-group" style="padding: 10px; box-shadow: 0px 4px #d0dcef;">
				        	<div>
					        	<h3 style="background: #605ca8; color: white; padding: 5px;">
					        		{{$dev->first_name}}, {{$dev->middle_name}}, {{$dev->last_name}}
					        	</h3>
					        </div>
					        <div>
					        	<textarea>{{$dev->skill_id}}</textarea>
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