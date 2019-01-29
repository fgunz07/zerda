@section('bootstrap_tables')
 	<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('data_tables')
	<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/dataTables.bootstrap4.min.js') }}")}}"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#skill-list').DataTable({
				// responsive: true,
				// 'dom': 'ftp',
				// 'pageLength': 10
			})

		});
	</script>
@endsection