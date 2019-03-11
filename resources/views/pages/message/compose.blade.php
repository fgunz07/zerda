@extends('pages.message.index')

@section('message_field')
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Compose New Message</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <input class="form-control" placeholder="To:" name="to">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Subject:" name="subject">
                </div>
                <div class="form-group">
                    <textarea id="compose" class="form-control"></textarea>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="pull-right">
                    <button type="button" class="btn btn-default" id="draft"><i class="fa fa-pencil"></i> Draft</button>
                    <button type="button" class="btn btn-primary" id="send"><i class="fa fa-envelope-o"></i> Send</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /. box -->
    </div>
@endsection

@section('custom_js')
    <script src="{{ asset('lib/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/http.js') }}"></script>
    <script type="text/javascript">
        const editor = CKEDITOR.replace('compose', { height: 300 })

        window.onload = function() {

          const options = {
            url   : '/messages/history',
            method  : 'GET'
          }

          http(options)
            .done(res => document.querySelector('#inbox-count').innerHTML = res.unread)
            .fail(err => swal('Error', err.responseJSON.message, 'error'))

        }

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

            http(options)
                .done(res => {
                    swal('Success', res.message, 'success')

                    setTimeout(function() {
                        window.location.reload()
                    }, 1000)
                })
                .fail(err => swal('Error', err.responseJSON.message, 'error'))
        }) 
    </script>
@endsection