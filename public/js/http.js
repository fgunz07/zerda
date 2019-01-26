const http = options => {

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