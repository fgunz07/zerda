<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $template = '
        	<div class="col-md-3">
	          <div class="box box-warning">
	            <div class="box-header with-border">
	            	<div class="input-group">
	            		<input type="text" class="form-control" name="todo_name" placeholder="Exp: Backlogs">
	            		<span class="input-group-addon text-success" style="cursor: pointer;" onclick="add()">
	            			<i class="fa fa-check"></i>
	            		</span>
	            	</div>
	            </div>
	            <!-- /.box-header -->
	          </div>
	          <!-- /.box -->
	        </div>
        ';

        $data = ['todos' => $template];

        DB::table('todos')
        	->insert($data);

    }
}
