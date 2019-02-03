@extends('layouts.app')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>Please Select. your a?</h1>

			<div class="form-group">
				{!! Form::select('role', $roles->pluck('name', 'name'), old('role', 1), ['class' => 'form-control select2']) !!}
			</div>
			<div class="fom-group">
				<button class="btn btn-success" id="select_role">Select</button>
			</div>
		</div>
	</div>
@endsection

@section('custom_script')
	<script type="text/javascript" src="{{ asset('lib/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/http.js') }}"></script>

	<script type="text/javascript">

		// select2 plugin
        $('.select2').select2()

        function saveRole(e) {
        	e.preventDefault()

        	let role = document.querySelector('select[name=role]').value

        	const options = {

        		url : '/select-role',
        		method: 'POST',
        		data: { roleName: role }

        	}

        	http(options)
        		.done(res => {

        			swal('Success', res.message, 'success')

        			setTimeout(() => {

        				window.location.href = '/dashboard'

        			}, 1000)

        		})
        		.fail(err => {

        			swal('Error', err.responseText, 'error')

        		})
        }

        document.querySelector('#select_role')
        		.addEventListener('click', saveRole)

	</script>
@endsection