@extends('apps.todolistApp.app')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Board details</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div id="display-boards">
                    <!-- content will load here automatically -->

                    {!! $board->html_code_accept !!}
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

@endsection

@section('custom_script')
    <script src="{{ asset('js/http.js') }}"></script>
    <script type="text/javascript">
        'use strict';

        (function() {

            function globalEvent(e) {

                e.preventDefault()

                if(e.target.classList.contains('board-invite-accept')) {

                    const options = {
                        url     : '/invitation/accept',
                        method  : 'POST',
                        data    : {
                            board_id    : e.target.id.split('-').pop(),
                            notf_id     : '{{ $notf_id }}'
                        }
                    }

                    http(options)
                        .done(res => {

                            swal('Success', res.message , 'success')
                        
                            window.location.href = '/todo-app/boards'

                        })
                        .fail(err => swal('Error', res.message , 'error'))

                }

                if(e.target.classList.contains('board-invite-reject')) {

                    const options = {
                        url     : '/invitation/reject',
                        method  : 'POST',
                        data    : {
                            notf_id     : '{{ $notf_id }}'
                        }
                    }

                    http(options)
                        .done(res => {

                            // swal('Success', res.message , 'success')
                        
                            window.location.href = '/todo-app/boards'

                        })
                        .fail(err => swal('Error', res.message , 'error'))

                }

            }

            window.addEventListener('click', globalEvent)

        })()
    </script>
@endsection