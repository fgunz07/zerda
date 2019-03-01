const httpN = options => {

	$.ajaxSetup({
		headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	})

	return $.ajax(options)
			.always(() => {
				// will always execute
			})

}

const notifInviteCount = document.querySelectorAll('.invite-count')
const notifInviteLoop  = document.querySelector('#invite-loop')
const notifMsgCount    = document.querySelectorAll('.message-count')
const notifMsgLoop 	   = document.querySelector('#message-loop')

function getInviteNotifications() {

	const options = {
		url		: '/notification/invite',
		method	: 'GET'
	}

	httpN(options)
		.done(res => {

			let html = ''

			notifInviteCount.forEach(item => item.innerHTML = res.length)

			res.forEach(item => {

				html += `
					<li>
						<a href="${item.data.board_url}?notf_id=${item.id}">${item.data.message}</a>
					</li>
				`

			})

			notifInviteLoop.innerHTML = html

		})
		.fail(err => {

			swal('Error', err.responseText, 'error')

		})

}

function getMessageNotifications() {

	const options = {
		url 	: '/notification/message',
		method 	: 'GET'
	}

	httpN(options)
		.done(res => {

			let html =''

			notifMsgCount.forEach(item => item.innerHTML = res.length)

			res.forEach(item => {

				html += `
					<li>
	                    <a href="${item.data.message_url}?notf_msg=${item.id}">
	                      <h4>
	                        ${item.data.from}
	                      </h4>
	                      <p>${item.data.notif}</p>
	                    </a>
	                 </li>

				`

			})

			notifMsgLoop.innerHTML = html

		})
		.fail(err => swal('Error', err.responseJSON.message, 'error'))

}

window.addEventListener('load', function() {
	getInviteNotifications()
	getMessageNotifications()
})