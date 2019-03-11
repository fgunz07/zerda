@extends('pages.message.index')

@section('message_field')
<div class="col-md-9">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Inbox</h3>

      <div class="box-tools pull-right">
        <div class="has-feedback">
          <input type="text" class="form-control input-sm" placeholder="Search Mail">
          <span class="glyphicon glyphicon-search form-control-feedback"></span>
      </div>
  </div>
  <!-- /.box-tools -->
</div>
<!-- /.box-header -->
<div class="box-body no-padding">
  <div class="table-responsive mailbox-messages">
      <table class="table table-hover table-striped">
        <tbody id="inbox">
            @foreach(auth()->user()->getDraft as $d)
	            <tr>
	            	<td><input type="checkbox" class=""></td>
	            	<td class="mailbox-name"><a href="#">{{$d->user->email}}</a></td>
	            	<td class="mailbox-subject"><b>{{$d->subject}}</b> {{$d->message_text}}
	            	</td>
	            	<td class="mailbox-attachment"></td>
	            	<td class="mailbox-date">
	            		{{$d->created_at}}
	            	</td>
	            </tr>
            @endforeach
        </tbody>
      </table>
  <!-- /.table -->
  </div>
<!-- /.mail-box-messages -->
</div>
<!-- /.box-body -->
<div class="box-footer no-padding">
  <div class="mailbox-controls">
    <div class="btn-group">
      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
  </div>
  <!-- /.btn-group -->
  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
  <div class="pull-right">
      1-50/200
      <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
    </div>
    <!-- /.btn-group -->
</div>
<!-- /.pull-right -->
</div>
</div>
</div>
<!-- /. box -->
</div>
@endsection

@section('custom_js')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/http.js') }}"></script>
    <script type="text/javascript">
        $('.inbox').dataTable({
            dom: 'ftip'
        })

        function loadMessages(res) {

          document.querySelector('#inbox-count').innerHTML = res.unread

          let html    = ''
          let status  = ''
          let style   = ''

          res.messages.forEach(item => {

            status = item.read > 0 ? '' : 'unread'
            style  = item.read > 0 ? '' : 'label label-warning'

            console.log(status)

            html += `
              
            `

          })

          document.querySelector('#inbox').innerHTML = html

        }

        window.onload = function() {

          const options = {
            url   : '/messages/history',
            method  : 'GET'
          }

          http(options)
            .done(res => loadMessages(res))
            .fail(err => swal('Error', err.responseJSON.message, 'error'))

        }
    </script>
@endsection