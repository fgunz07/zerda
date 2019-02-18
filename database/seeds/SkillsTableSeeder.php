<?php

use Illuminate\Database\Seeder;
use App\Skill;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	$arr = [
    		['name' => 'HTML',    'class' => 'label label-danger'],
    		['name' => 'HTML5',   'class' => 'label label-danger'],
    		['name' => 'CSS',     'class' => 'label label-primary'],
    		['name' => 'CSS3',    'class' => 'label label-danger'],
    		['name' => 'Javascript','class' => 'label label-warning'],
    		['name' => 'ES6 (Javascript 2016)', 'class' => 'label label-warning'],
    		['name' => 'TypeScript', 'class' => 'label label-primary'],
    		['name' => 'SQL', 'class' => 'label label-default'],
    		['name' => 'C#', 'class' => 'label label-default'],
    		['name' => 'C++' , 'class' => 'label label-primary'],
    		['name' => '.NET', 'class' => 'label label-primary'],
    		['name' => 'VueJS', 'class' => 'label label-success'],
    		['name' => 'Angular', 'class' => 'label label-danger'],
    		['name' => 'React', 'class' => 'label label-primary'],
    		['name' => 'NativeScript', 'class' => 'label label-primary'],
    		['name' => 'Java', 'class' => 'label label-danger'],
    		['name' => 'Python', 'class' => 'label label-warning'],
    		['name' => 'Ruby', 'class' => 'label label-danger'],
    		['name' => 'Go', 'class' => 'label label-primary'],
    		['name' => 'Lua', 'class' => 'label label-default'],
    		['name' => 'Unit Testing', 'class' => 'label label-default'],
    		['name' => 'JQuery', 'class' => 'label label-default'],
    		['name' => 'NodeJS', 'class' => 'label label-success'],
    		['name' => 'Meteor', 'class' => 'label label-danger'],
    		['name' => 'Laravel', 'class' => 'label label-danger'],
    		['name' => 'Linux', 'class' => 'label label-danger'],
    		['name' => 'MongoDB', 'class' => 'label label-success'],
    		['name' => 'API Creation', 'class' => 'label label-warning'],
    	];

    	foreach($arr as $key=>$value) {

    		Skill::create(['name' =>$value['name'], 'class' => $value['class']]);

    	}

    }
}
