@extends('pages.message.index')

@section('message_field')
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Show Message</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <h5>
                    <b>
                        From: {{ $message->user->email }}
                    </b>
                </h5>
                <blockquote>
                    {!! $message->message_html !!}
                    <small><cite title="Source Title">{{ $message->created }}</cite></small>
                </blockquote>
                
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-sm" id="reply" data-toggle="modal" data-target="#compose">
                        <i class="glyphicon glyphicon-share-alt"></i>&nbsp;Reply
                    </button>
                </div>
                <a href="{{ url('messages/inbox') }}" class="btn btn-default btn-sm"><i class="fa fa-times"></i> Discard</a>
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /. box -->
    </div>

    <div class="modal fade in" id="compose">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Compose Message</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control" placeholder="To:" name="to" value="{{ $message->user->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Subject:" name="subject" value="{{ $message->subject }}" readonly>
                    </div>
                    <div class="form-group">
                        <textarea id="editor" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="discard"><i class="glyphicon glyphicon-floppy-save" id="draft"></i> Draft</button>
                    <button type="button" class="btn btn-primary" id="send"><i class="glyphicon glyphicon-send" id="send"></i> Send</button>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
@endsection

@section('custom_js')

    <script src="{{ asset('lib/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/http.js') }}"></script>
    <script type="text/javascript">
        const editor = CKEDITOR.replace('editor', { height: 250 })

        window.onload = function() {

          const options = {
            url   : '/messages/history',
            method  : 'GET'
          }

          http(options)
            .done(res => document.querySelector('#inbox-count').innerHTML = res.unread)
            .fail(err => swal('Error', err.responseJSON.message, 'error'))

        }

        $('#draft').on('click', function(e) {

            let options = {
                url     : '/messages/draft',
                method  : 'POST',
                data    : {
                    to      : $('input[name=to]').val(),
                    sub     : $('input[name=subject]').val(),
                    html    : editor.getData(),
                    text    : editor.editable().getText()
                }
            }

            console.log(options)

            http(options)
                .done(res => swal('Success' , 'Message sent.', 'success'))
                .fail(err => swal('Error', err.responseJSON.message, 'error'))

        })

        $('#send').on('click', function(e) {

            let options = {
                url     : '/messages/compose',
                method  : 'POST',
                data    : {
                    to      : $('input[name=to]').val(),
                    sub     : $('input[name=subject]').val(),
                    html    : editor.getData(),
                    text    : editor.editable().getText()
                }
            }

            http(options)
                .done(res => swal('Success' , 'Message sent.', 'success'))
                .fail(err => swal('Error', err.responseJSON.message, 'error'))

        })
    </script>

@endsection