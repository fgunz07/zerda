@extends('layouts.app')
@section('content')
<div class="col-md-offset-2">
	<div class="col-md-8">
	  <!-- Horizontal Form -->
	  <div class="box box-primary">
	    <div class="box-header with-border">
	      <h3 class="box-title">New Rate Description</h3>
	    </div>
	    <!-- /.box-header -->
	    <!-- form start -->
		@if(isset($data))
            {!! Form::model($data,['url'=>['ratingdesc-update', $data->id], 'method'=>'PUT']) !!}
      	@else
            {!! Form::open(['url'=>['ratingdesc-store'], 'method'=>'POST','class'=>'form-horizontal']) !!}
      	@endif
	      <div class="box-body">
	        <div class="form-group">
	          <label for="inputEmail3" class="col-sm-2 control-label">Description</label>

	          <div class="col-sm-10">
	            {!!Form::text('description',old('description'),['class'=>'form-control'])!!}
	          </div>
	        </div>
	      </div>
	      <!-- /.box-body -->
	      <div class="box-footer">
	        <a type="button" href="{{ url('ratingdesc-list') }}" class="btn btn-danger">Cancel</a>
	        <button type="submit" class="btn btn-primary pull-right">Submit</button>
	      </div>
	      <!-- /.box-footer -->
	    {!! Form::close() !!}
	  </div>
	</div>	
</div>
@endsection
