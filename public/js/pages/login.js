const loginModule = selector => {

	// remember function 
	// the checkbox
	const remember = options => {

		$(selector).iCheck(options)

	}

	return {

		initLoginRemember: remember

	}

}
