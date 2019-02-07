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
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

@endsection

@section('custom_script')
    <script type="text/javascript">
        'use strict';

        (function() {

            

        })()
    </script>
@endscript