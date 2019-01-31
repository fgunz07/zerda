<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(){
        $skills = Skill::all();
        return view('pages.profile.show')
            ->with('skills',$skills);
    }

    public function uploadProfile(){

    }

    public function updateLocation(){

    }

    public function updateEducation(){

    }

    public function updateSkill(){

    }

    public function updateNotes(){

    }
}
