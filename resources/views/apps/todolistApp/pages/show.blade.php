@extends('apps.todolistApp.app')

@section('custom_css')
	<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
	<input type="hidden" name="board_id" value="{{ $board->id }}">
	<h1 style="display: inline-block;">{{ $board->title }}</h1>
	<a href="{{ url('/todo-app/boards') }}" class="btn btn-danger btn-xs pull-righ">
		<i class="glyphicon glyphicon-menu-left"></i>
		Back
	</a>

	<div class="modal fade in" id="rate-devs">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Rate Developers</h4>
					</div>
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	<div class="row">
		<div class="display">
			@foreach($board->todos as $todo)
				
				{!! $todo->html_code !!}

			@endforeach
		</div>
		@hasanyrole('Senior Developer|Client')
			<div class="col-sm-3">
				<div class="input-group">
					<input type="text" class="form-control" name="todo_name" placeholder="Todo name">
					<span class="input-group-addon">
						<a href="javascript:void(0);" id="add_todo"><i class="fa fa-check"></i></a>
					</span>
				</div>
			</div>
		@endhasanyrole
	</div>

	<div class="modal fade in" id="new-task">
		<div class="modal-dialog modal-sm">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
			  <h4 class="modal-title">New Task</h4>
			</div>
			<div class="modal-body">
				  <div class="form-horizontal">
					  <div class="form-group">
					  	<label for="board-t" class="col-sm-2 control-label">Task</label>
	  
						  <div class="col-sm-10">
							  <input type="text" class="form-control" name="task_name" id="board-t" placeholder="Task name">
						  </div>
					  </div>
	
					  <div class="form-group">
						  <div class="col-sm-2">
							  <label for="">Class</label>
						  </div>
						  <div class="col-sm-10">
							  <input type="radio" class="radio-class" value="callout-info" id="callout-info" style="display:none;">
							  <label for="callout-info" class="label" style="height: 20px;width:20px;display:inline-block;margin: 10px;background: #00c0ef;cursor:pointer;"></label>
							  <input type="radio" class="radio-class" value="callout-warning" id="callout-warning" style="display:none;">
							  <label for="callout-warning" class="label" style="height: 20px;width:20px;display:inline-block;margin: 10px;background: #f39c12;cursor:pointer;"></label>
							  <input type="radio" class="radio-class" value="callout-success" id="callout-success" style="display:none;">
							  <label for="callout-success" class="label" style="height: 20px;width:20px;display:inline-block;margin: 10px;background: #00a65a;cursor:pointer;"></label>
						  </div>
					  </div>
				  </div>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			  <button type="button" class="btn btn-primary" id="saveTask">Save</button>
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	<div class="modal fade in" id="devs">
		<div class="modal-dialog modal-sm">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
			  <h4 class="modal-title">Assign</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-striped dataTable">
                    <thead>
                    <tr role="row">
                        <th>Select</th>
                        <th>Developer</th>
                    </tr>
                    </thead>
                    <tbody id="table-display-devs">
                    	@foreach($board->users as $dev)
                    		@if(!$dev->hasRole('Client'))
	                    		<tr>
	                    			<td>
	                    				<input type="radio" name="dev" class="radio-devs" id="dev-{{ $dev->id }}" value="{{ $dev->first_name }} {{ $dev->middle_name }} {{ $dev->last_name }}">
	                    			</td>
	                    			<td>
	                    				<label for="dev-{{ $dev->id }}">
	                    					{{ $dev->first_name }} {{ $dev->middle_name }} {{ $dev->last_name }}
	                    				</label>
	                    			</td>
	                    		</tr>
                    		@endif
                    	@endforeach
                    </tbody>
                </table>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	<div class="modal fade in" id="end">
		<div class="modal-dialog modal-sm">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
			  <h4 class="modal-title">Date End</h4>
			</div>
			<div class="modal-body">
				<input type="text" class="datepicker form-control" name="end_date">
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
			</div>
		  </div>
		  <!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

@endsection

@section('custom_script')
	<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('lib/sortablejs/sortable.min.js') }}"></script>
	<script src="{{ asset('js/http.js') }}"></script>
	<script type="text/javascript">
		'use strict';

		(function(){

			$('.datepicker').datepicker({
				format: 'yyyy-mm-dd'
			})
			.on('changeDate', function(e) {

				const options = {
					url 	: '/todo-app/todo/end_date',
					method 	: 'POST',
					data 	: {
						task_id : selectedTodo,
						date 	: this.value
					}
				}

				http(options)
					.done(res => window.location.reload())
					.fail(err => swal('Error', err.responseJson.message , 'error'))

			})

			const arrayRadioBTN     = document.querySelectorAll('.radio-class')
			const arrayRadioLabel   = document.querySelectorAll('.label')
			const sortables 		= document.querySelectorAll('.sortable')
			const radioBtn 			= document.querySelectorAll('.radio-devs')

			let todoId 		 = null
			let currentSrcEl = null
            let currentCheck = null
            let selectUserName= null
			let selectedTodo = 0
			let status 		 = {{ auth()->user()->hasAnyRole('Senior Developer|Client') ? true : false }}

            radioBtn.forEach(item => {

            	item.addEventListener('change', e => {

            		let options = {
            			url		: '/todo-app/todo/assign',
            			method 	: 'POST',
            			data 	: {
            				task_id : selectedTodo,
            				dev 	: e.target.value
            			}
            		}

            		http(options)
            			.done(res => {
            				// do nothing .

            				window.location.reload()
            			})
            			.fail(err => swal('Error', err.message, 'error'))

            	})

            })

            arrayRadioLabel.forEach(item => {
                item.addEventListener('click', function(e) {

                    if(!!currentSrcEl && !!currentCheck) {

                        currentSrcEl.style.border = ''

                        currentCheck.removeAttribute('checked')
                    
                    }

                    currentSrcEl = this

                    currentCheck = document.getElementById(this.htmlFor)

                    currentCheck.setAttribute('checked', 'checked')

                    this.style.border = '1.5px solid #605ca8'
                })
			})
			
			function addTask(e) {

				let options = {
					url		: '/todo-app/tasks',
					method  : 'POST',
					data	: {
						tasks		: document.querySelector('input[name=task_name]').value,
						class_name	: document.querySelector('input[checked=checked]').value,
						todo_id 	: todoId
					}
				}

				http(options)
					.done(res => {

						swal('Success', res.message, 'success')

						window.location.reload()

						return

					})
					.fail(err => {

						swal('Error', err.responseText, 'error')

					})

			}

			function loadTodos() {

				const options = {
					url		: '/todo-app/todos',
					method	: 'GET'
				}

				http(options)
					.done(res => {

						return

						const displayEl = document.querySelector('div.display')

						displayEl.innerHTML = ''

						res.froEach(item => {

							displayEl.insertAdjacentHTML('beforebegin', item.html_code)

						})

						return

					})
					.fail(err => {
					
						swal('Error', err.responseText, 'error')
					
					})

			}

			function addTodos(e) {

				const options = {
					url		: '/todo-app/todos',
					method	: 'POST',
					data	: {
					
						todos		: document.querySelector('input[name=todo_name]').value,
						board_id	: document.querySelector('input[name=board_id]').value
					
					}
				}

				http(options)
					.done(res => {

						swal('Success', res.message ,'success')

						window.location.reload()

						return

					})
					.fail(err => {

						swal('Error', err.responseText, 'error')

						return

					})

			}

			function globalEvents(e) {

				let targetId = null
				let options  = {}

				if(e.target.classList.contains('remove-todo')) {

					targetId = (e.target.id).split('-').pop()

					options  = {
						url		: `/todo-app/todos/${targetId}`,
						method	: 'DELETE'
					}

					http(options)
						.done(res => {

							if(res.status) {

								swal('Success', res.message, 'success')

								window.location.reload()

								return

							}

						})
						.fail(err => {

							swal('Err', err.responseText , 'error')

						})

				}

				if(e.target.classList.contains('btn-add-task')) {

					todoId = (e.target.id).split('-').pop()

				}

				if(e.target.classList.contains('glyphicon-user')) {

					selectedTodo = e.target.id.split('-').pop()

				}

				if(e.target.classList.contains('glyphicon-calendar')) {

					selectedTodo = e.target.id.split('-').pop()

				}

			}

			sortables.forEach(item => {

				new Sortable(item , {

					group		: 'group1',
					animation	: 150,
					onStart		: function(/**Event*/evt) {

						this.currentPosition = {

							todo_id: (evt.target.parentElement.id).split('-').pop(),
							task_id: (evt.target.id).split('-').pop()

						}

					},
					onAdd		: function (/**Event*/evt) {
						
						let todoId		= (evt.target.parentElement.id).split('-').pop()
						let tasksId		= (evt.item.id).split('-').pop()
						let oldParent 	= (evt.from.parentElement.id).split('-').pop()

						let options = {

							url 	: '/todo-app/todo-task',
							method	: 'POST',
							data	: {
								old		: oldParent,
								todo_id	: todoId,
								task_id : tasksId
							
							}

						}

						http(options)
							.done(res => {

								// do nothing 

								return

							})
							.fail(err => {

								swal('Error', err.responseText, 'error')

							})

					},

				})

			})

			if(status) {

				document.querySelector('#add_todo').addEventListener('click', addTodos)

			}

			document.querySelector('#saveTask').addEventListener('click', addTask)

			window.addEventListener('click', globalEvents)

			loadTodos()

		})()
	</script>
@endsection