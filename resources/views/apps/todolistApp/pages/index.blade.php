@extends('apps.todolistApp.app')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('lib/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Projects</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div id="display-boards">
                    <!-- content will load here automatically -->
                </div>

                <div class="col-sm-3">
                    @hasrole('Client')
                        <button class="btn btn-app" data-toggle="modal" data-target="#new-board">
                            <i class="glyphicon glyphicon-plus"></i>
                        </button>
                    @endhasrole
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="modal fade in" id="devs-list">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">List of Developers</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped dataTable">
                    <thead>
                    <tr role="row">
                        <th>Dev Name</th>
                        <th>Skills</th>
                        <th>Option</th>
                        {{--  <th>Engine version</th>
                        <th>CSS grade</th>  --}}
                    </tr>
                    </thead>
                    <tbody id="table-display-devs">
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              {{--  <button type="button" class="btn btn-primary" id="saveBoard">Save</button>  --}}
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

    <div class="modal fade in" id="new-board">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">New Project</h4>
          </div>
          <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="board-t" class="col-sm-2 control-label">Project:</label>
    
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" id="board-t" placeholder="Project name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="board-t" class="col-sm-2 control-label">Budget:</label>
    
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="budget">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="board-t" class="col-sm-2 control-label">End Date:</label>
    
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="end_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="board-d" class="col-sm-2 control-label">Description</label>
                        
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter board description ..."></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="board-t" class="col-sm-2 control-label">Tags:</label>
    
                        <div class="col-sm-10">
                            {!! Form::select('tags[]', $skills->pluck('name', 'id'), old('tags[]'), ['class' => 'form-control', 'multiple' => 'multiple', 'name' => 'tags[]', 'style' => 'width: 100%;']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="">Class</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="radio" class="radio-class" value="callout-info" id="callout-info" style="display:none;">
                            <label for="callout-info" class="label" style="height: 20px;width:20px;display:inline-block;margin: 10px;background: #00c0ef;cursor:pointer;"></label>
                            <input type="radio" class="radio-class" value="callout-warning" id="callout-warning" style="display:none;">
                            <label for="callout-warning" class="label" style="height: 20px;width:20px;display:inline-block;margin: 10px;background: #f39c12;cursor:pointer;"></label>
                            <input type="radio" class="radio-class" value="callout-success" id="callout-success" style="display:none;">
                            <label for="callout-success" class="label" style="height: 20px;width:20px;display:inline-block;margin: 10px;background: #00a65a;cursor:pointer;"></label>
                        </div>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveBoard">Save</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

@endsection

@section('custom_script')
    <script type="text/javascript" src="{{ asset('lib/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/http.js') }}"></script>
    <script type="text/javascript">
        'use strict';

        (function() {

            $('select[name="tags[]"]').select2()

            $('input[name=end_date]').datepicker({
                format: 'yyyy-mm-dd'
            })

            const arrayRadioBTN     = document.querySelectorAll('.radio-class')
            const arrayRadioLabel   = document.querySelectorAll('.label')
            const deleteBoard       = null

            let currentSrcEl = null
            let currentCheck = null

            arrayRadioLabel.forEach(item => {
                item.addEventListener('click', function(e) {

                    if(!!currentSrcEl && !!currentCheck) {

                        currentSrcEl.style.border = ''

                        currentCheck.removeAttribute('checked')
                    
                    }

                    currentSrcEl = this

                    currentCheck = document.getElementById(this.htmlFor)

                    currentCheck.setAttribute('checked', 'checked')

                    this.style.border = '1.5px solid #605ca8'
                })
            })

            function renderBoards(elements) {

                const display = document.querySelector('#display-boards')
                
                display.innerHTML = ''

                if(elements) {

                    elements.forEach(item => {

                        display.insertAdjacentHTML('afterbegin', item.html_code)
    
                    })

                }

            } 

            function renderDevs(users) {

                if(users) {

                    users.forEach(item => {

                        document.querySelector('#table-display-devs')
                                .innerHTML += `
                                <tr>
                                    <td>${item.first_name} ${item.middle_name} ${item.last_name}</td>
                                    <td>
                                        ${item.skill}
                                    </td>
                                    <td class="text-right">
                                        <button class="btn btn-success invite" id="user-details-${item.id}">Invite</button>
                                    </td>
                                </tr>
                                `;

                    })

                }

            }

            function loadBoard() {

                const options = {
                    url     : '/todo-app/boards/list',
                    method  : 'GET'
                }

                http(options)
                    .done(res => {
                        renderBoards(res.data)
                    })
                    .fail(err => {
                        swal('Error', err.message, 'error')
                    })

            }

            function loadAvailableUsers(id) {

                let options = {
                    url     : '/users',
                    method  : 'GET',
                    data    : { board : id }
                }

                http(options)
                    .done(res => {
                        renderDevs(res)

                        $('.dataTable').dataTable()
                    })
                    .fail(err => {
                        console.log(err)
                    })

            }

            let strId;

            function globalEvents(e) {

                if(e.target.classList.contains('invite')) {

                    let id = e.target.id.split('-').pop()

                    const options = {
                        url     : '/notification/invite',
                        method  : 'POST',
                        data    : {
                            target_user: id,
                            target_board: strId
                        }
                    }

                    http(options)
                        .done(res => {

                            swal('Success', res.message , 'success')

                        })
                        .fail(err => {

                            swal('Error', err.responseText, 'error')

                        })

                }

                if(e.target.classList.contains('board-invite')) {

                    strId = e.target.id.split('-').pop()

                    loadAvailableUsers(strId)

                }

                let targetId = null
                let options  = {} 

                if(e.target.classList.contains('close')) {

                    targetId = (e.target.id).split('-').pop()

                    options = {
                        url     : `/todo-app/boards/${targetId}`,
                        method  : 'DELETE',
                    }

                    http(options)
                        .done(res => {
                            if(res.status) {
                                swal('Success', res.message, 'success')

                                loadBoard()

                                return
                            }
                        })
                        .fail(err => {

                            swal('Error', err.responseJSON, 'error')

                        })
                }

            }

            document.getElementById('saveBoard')
                    .addEventListener('click', function(e) {

                        let data = {
                            title       : document.querySelector('input[name=title]').value,
                            description : document.querySelector('textarea[name=description]').value,
                            class_name  : document.querySelector('input[checked=checked]').value,
                            budget      : document.querySelector('input[name=budget]').value,
                            end_date    : document.querySelector('input[name=end_date]').value,
                            tags        : $('select[name="tags[]"]').val()
                        }

                        let options = {
                            url     : '/todo-app/boards',
                            method  : 'POST',
                            data    : data
                        }

                        http(options)
                            .done(res => {
                                if(res.status) {
                                    swal('Success', res.message, 'success')

                                    loadBoard()

                                    return
                                }
                            })
                            .fail(err => {

                                console.log(err)

                                swal('Error', err.message, 'error')

                            })
                    })
            
            // load boards
            loadBoard()

            // add window event for event delegation on elements
            window.addEventListener('click', globalEvents)

        })()
    </script>
@endsection