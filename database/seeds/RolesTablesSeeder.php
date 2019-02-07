<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// roles default data
        $roles = [

        	[
        		'name' 		=> 'Client',
        		'guard_name'=> 'web'
        	],

        	[
        		'name' 		=> 'Senior Developer',
        		'guard_name'=> 'web'
        	],

        	[
        		'name' 		=> 'Developer',
        		'guard_name'=> 'web'
        	]
        ];

        foreach ($roles as $key => $value) {
        	
        	Role::create(['name' => $value['name'], 'guard_name' => $value['guard_name']]);
        
        }

        $perms = [
        	
        	[
        		'name' 		=> 'Create project',
        		'guard_name'=> 'web'
        	],

        	[
        		'name' => 'Invite member',
        		'guard_name'=> 'web'
        	],

        	[
        		'name' => 'Assign senior developer',
        		'guard_name'=> 'web'
        	],

        	[
        		'name' => 'Approve',
        		'guard_name'=> 'web'
        	],

        	[
        		'name' 		=> 'Overall percentage',
        		'guard_name'=> 'web'
        	],

        	[
        		'name' 		=> 'List TO DO',
        		'guard_name'=> 'web'
        	],

        	[
        		'name' 		=> 'Distribute TO DO',
        		'guard_name'=> 'web'
        	],

        	[
        		'name' 		=> 'Edit project',
        		'guard_name'=> 'web'
        	],

        	[
        		'name' 		=> 'See TO DO',
        		'guard_name'=> 'web'
        	],

        	[
        		'name'		=> 'Move TO DO',
        		'guard_name'=> 'web'
        	]

        ];

        foreach ($perms as $key => $value) {

        	Permission::create(['name' => $value['name'], 'guard_name' => $value['guard_name']]);

        }

        $createProject			= Permission::find(1);
        $inviteMember 			= Permission::find(2);
        $assignSeniorDeveloper 	= Permission::find(3);
        $approve 	  			= Permission::find(4);
        $overallPercentage 		= Permission::find(5);
        $listTODO 	  			= Permission::find(6);
        $distributeTODO			= Permission::find(7);
        $editProject  			= Permission::find(8);
        $seeTODO				= Permission::find(9);
        $moveTODO				= Permission::find(10);

        $client 		= Role::find(1);
        $siniorDeveloper= Role::find(2);
        $developer 		= Role::find(3);

        $client->givePermissionTo([$createProject, $inviteMember, $assignSeniorDeveloper, $approve, $overallPercentage, $listTODO]);
        // $client->givePermissionTo($inviteMember);
        // $client->givePermissionTo($assignSeniorDeveloper);
        // $client->givePermissionTo($approve);
        // $client->givePermissionTo($overallPercentage);
        // $client->givePermissionTo($listTODO);

    }
}
