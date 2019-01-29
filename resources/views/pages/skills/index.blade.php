@extends('layouts.app')
@section('content')
@if(session()->has('save'))
  <div class="row" id="save">
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <strong>Notification:</strong>{{ session()->get('save') }}
    </div>
  </div>
@endif

@if(session()->has('edit'))
  <div class="row" id="edit">
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <strong>Notification:</strong>{{ session()->get('edit') }}
    </div>
  </div>
@endif

<div class="row">
   	<div class="col-md-10 col-md-offset-1">
  	 <div class="row">
        <div class="col-md-12">

        	<div class="box box-primary">
	            <div class="box-header">
	              <h3 class="box-title">List of Skill/Specialization</h3>
	            </div>
	            <div class="pull-right" style="padding: 5px;"> 
	            	<a href="{{ url('skills-create') }}" type="button" class="btn btn-primary"><i class="	glyphicon glyphicon-plus"></i>Add Skill</a>
	            </div>
            
	            <div class="box-body">
	              <table id="skill-list" class="table table-bordered table-striped">
	                <thead>
	                <tr>
	                  <th>Description</th>
	                  <th class="text-center">Action</th>
	                </tr>
	                </thead>
	                <tbody>
            	 	@foreach($data as $value)	
		                <tr>
		                  <td>
		                  	<input type="hidden" class="skillID" value="{{$value->id}}">
		                  	{{$value->description}}
		                  </td>
		           		  <td>
	           		  		<div class="an-settings-button pull-right" style="border: transparent;">

	           		  			 <a href="{{url('skills-edit',$value->id)}}" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i></a>

			                    <button class="btn btn-danger delete-skill"><i class="glyphicon glyphicon-trash"></i></button>

		                  	</div>	
		           		  </td>
		                </tr>
	                @endforeach
	              </table>
	            </div>
            
          </div>	
      </div>
  	</div>
</div>
@endsection

@include('layouts.options.bootstrap-dataTable')

@section('custom_js')
  @include('pages.skills.script.skills-script')
@endsection