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
        $specializations = Specialization::where('user_id',Auth::user()->id)->get();
        // dd($specializations);
        return view('pages.profile.show')
                ->with('skills',$skills)
                ->with('specializations',$specializations);
            
    }

    public function dataProfile(){
        
        $education = Education::where('user_id',Auth::user()->id)->get();
        $locations = Location::where('user_id',Auth::user()->id)->get();
       
        // dd($specializations);

        return response()->json(['education'=>$education,'locations'=>$locations]);
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

        $location = Location::updateOrCreate(
            ['user_id'=>Auth::user()->id],
            [
                'street' =>$request->street,
                'brgy' => $request->brgy,
                'city' => $request->city,
                'province' => $request->province,
                'country' => $request->country
            ]
        );

    }

    public function updateEducation(Request $request){
        
        $education = Education::updateOrCreate(
            ['user_id'=>Auth::user()->id],
            [
                'primary' =>$request->primary,
                'secondary' => $request->secondary,
                'tertiary' => $request->tertiary
            ]
        );
    }

    public function updateSkill(Request $request){
        // $skill = Specialization::updateOrCreate(
        //     ['user_id' => Auth::user()->id],
        //     [
        //         'name'=>$request->name
        //     ]
        // );
        $skill = new Specialization;
        $skill->user_id = Auth::user()->id;
        $skill->name = $request->name;

        $skill->save();
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
