<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Skill;
use App\Location;
use App\Education;
use App\Profile;
use App\Specialization;

class ProfileController extends Controller
{
    public function show(){
        $skills = Skill::all();
        $specializations = Specialization::all();
        $locations = Location::all();
        // dd($locations); 
        return view('pages.profile.show')
            ->with('skills',$skills)
            ->with('specializations',$specializations)
            ->with('locations',$locations);
    }

    public function uploadProfile(){

        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

  

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

  

        request()->image->move(public_path('images'), $imageName);

  

        return back()

            ->with('success','You have successfully upload image.')

            ->with('image',$imageName);

    }

    public function updateLocation(Request $request){

        $locatoion = Location::updateOrCreate(
            ['user_id'=>Auth::user()->id],
            [
                'street'=>$request->street,
                'brgy'=>$request->brgy,
                'city'=>$request->city,
                'province'=>$request->provice,
                'country'=>$request->country
            ]
        );
    }

    public function updateEducation(Request $request){
        
        $education = Education::updateOrCreate(
            ['user_id'=>Auth::user()->id],
            [
                'primary'=>$primary,
                'secondary'=>$secondary,
                'tertiary'=>$tertiary
            ]
        );
    }

    public function updateSkill(Request $request){
        $skill = Specialization::updateOrCreate(
            ['user_id' => Auth::user()->id],
            [
                'name'=>$request->name
            ]
        );
    }

    public function deleteSkill($id){
        Skill::find($id)->delete();
    }

    public function updateNotes(Request $request){
        $note = new Profile();
        $note->note = $request->note;
        $note->update();
    }
}
