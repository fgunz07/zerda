@extends('apps.todolistApp.app')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Your Boards</h3>
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

    <div class="modal fade in" id="new-board">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">New Board</h4>
          </div>
          <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                    <label for="board-t" class="col-sm-2 control-label">Email</label>
    
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" id="board-t" placeholder="Board Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="board-d" class="col-sm-2 control-label">Description</label>
                        
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter board description ..."></textarea>
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
    <script type="text/javascript" src="{{ asset('js/http.js') }}"></script>
    <script type="text/javascript">
        'use strict';

        (function() {
            const arrayRadioBTN     = document.querySelectorAll('.radio-class')
            const arrayRadioLabel   = document.querySelectorAll('.label')
            const deleteBoard       = null

            window.addEventListener('click', function(e) {

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
            })

            let currentSrcEl = null;
            let currentCheck = null;

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

                elements.forEach(item => {

                    display.insertAdjacentHTML('afterbegin', item.html_code)

                })

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

            document.getElementById('saveBoard')
                    .addEventListener('click', function(e) {

                        let data = {
                            title       : document.querySelector('input[name=title]').value,
                            description : document.querySelector('textarea[name=description]').value,
                            class_name  : document.querySelector('input[checked=checked]').value
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

                                swal('Error', err.message, 'error')

                            })
                    })
            
            // load boards
            loadBoard()

        })()
    </script>
@endsection