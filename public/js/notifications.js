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

const notifCount = document.querySelectorAll('.notif-count')
const notifLoop  = document.querySelector('#notf-loop')

function getNotifications(e) {

	const options = {
		url		: '/notification/invite',
		method	: 'GET'
	}

	httpN(options)
		.done(res => {

			notifCount.forEach(item => item.innerHTML = res.length)

			res.forEach(item => {

				let html = `
					<li>
						<a href="${item.data.board_url}?notf_id=${item.id}">${item.data.message}</a>
					</li>
				`

				notifLoop.innerHTML = html

			})

		})
		.fail(err => {

			swal('Error', err.responseText, 'error')

		})

}

window.addEventListener('load', getNotifications)