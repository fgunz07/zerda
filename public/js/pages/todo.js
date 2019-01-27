	const todoWrapper 	= $('#display')
	const addButton 	= $('#add')

	// create handles all methods
	class todoApp {

		constructor() {
			this.optionList 	= {
				url: '/todo-app/todos-list',
				method: 'GET'
			}
			this.optionsStoreTodo 	= {
				url: '/todo-app/todos-list',
				method: 'POST'
			}
			this.optionsStoreTask 	= {
				url: '/todo-app/tasks-list',
				method: 'POST'
			}
		}

		renderTodo($el) {

			$el.empty()

			// http function global method -> http.js
			this.httpRequest(this.optionList)
				.done(res => {

					// response is an array
					// loop to the response
					res.forEach(item => {

						// each item in the response append the todos
						$el.append(item.html_code)

						$('.sortable').sortable()

						return
					})
				
				})
				.fail(err => {

					// if error
					alert(err.responseText)
				
				})
		}

		// will be use every time save request
		httpRequest(options) {

			return http(options)

		}

		// add todo
		addTodo(val) {

			this.optionsStoreTodo.data = {
				todos: val
			}

			this.httpRequest(this.optionsStoreTodo)
				.done(res => {
					console.log(res)
				})
				.fail(err => {
					alert(err.responseText)
				})

		}

		//

		// add task
		addTask(obj) {

			this.optionsStoreTask.data = {
				tasks 	: obj.tasks,
				todo_id : obj.todo_id 
			}

			this.httpRequest(this.optionsStoreTask)
				.done(res => {
					console.log(res)
				})
				.fail(err => {
					alert(err.responseText)
				})
		}

	}

	// instantiate the class
	const app = new todoApp()

	// call the method of the class
	app.renderTodo(todoWrapper)

	function addTodo() {

		let todoName = $('input[name=todo_name]').val()

		app.addTodo(todoName)

		app.renderTodo(todoWrapper)

	}

	function addTask() {

		let taskName = $('input[name=task_name]').val()

		let todo_id  = $('input[name=todo_id]').val()


		let obj 	= { tasks: taskName, todo_id: todo_id }

		app.addTask(obj)

		app.renderTodo(todoWrapper)

	}

	

	// let parentEl = null;

	// function allowDrop(event) {

	// 	// prevent default
	// 	event.preventDefault()

	// }

	// function dropEl(event) {

	// 	event.preventDefault()

	// 	event.dataTransfer.dropEffect = 'move'

	// 	let id = event.dataTransfer.getData('text/html')

	// 	event.target
	// 			.appendChild(document.getElementById(id))

	// }

	// function dontAllowDrop(event) {

	// }

	// function dragEl(event) {

	// 	event.dataTransfer.effectAllowed = 'move'

	// 	event.dataTransfer.setData('text/html', event.target.id)

	// }