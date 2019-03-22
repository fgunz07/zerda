@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-md-3">
        <a href="{{ url('messages/compose') }}" class="btn btn-primary btn-block margin-bottom">Compose</a>

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Folder</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="">
                        <a href="{{ url('messages/inbox') }}"><i class="fa fa-inbox"></i> Inbox
                            <span class="label label-primary pull-right" id="inbox-count"></span>
                        </a>
                    </li>
                    <li><a href="{{ url('messages/sent') }}"><i class="fa fa-envelope-o"></i> Sent<span class="label label-success pull-right" id="sent-count"></span></a></li>
                    <li><a href="{{ url('messages/draft') }}"><i class="fa fa-file-text-o"></i> Drafts <span class="label label-warning pull-right" id="draft-count"></span></a></li>
                    <li><a href="{{ url('messages/trash') }}"><i class="fa fa-trash-o"></i> Trash <span class="label label-danger pull-right" id="trash-count"></span></a></li>

                    {{-- <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                    <li><a href="{{ url('messages/draft') }}"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                    <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
                    </li>
                    <li><a href=""><i class="fa fa-trash-o"></i> Trash</a></li> --}}
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
        {{--  <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Labels</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->  --}}
    </div>

    @yield('message_field')

</div>

@endsection