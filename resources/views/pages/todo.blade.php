@extends('layouts.app')

@section('content')
	<div class="row" id="todo_app">
		<div id="display">
		</div>
		<div id="default">
			<div class="col-md-3">
	          <div class="box box-warning">
	            <div class="box-header with-border">
	            	<div class="input-group">
	            		<input type="text" class="form-control" name="todo_name" placeholder="Exp: Backlogs">
	            		<span class="input-group-addon" style="cursor: pointer;" onclick="addTodo()">
	            			<a href="javascript:void(0);"class="text-success">
	            				<i class="fa fa-check"></i>
	            			</a>
	            		</span>
	            	</div>
	            </div>
	            <!-- /.box-header -->
	          </div>
	          <!-- /.box -->
	        </div>
		</div>
	</div>
@endsection

@section('custom_script')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js"></script>
	<script type="text/javascript" src="{{ asset('js/http.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/todo.js') }}"></script>
@endsection