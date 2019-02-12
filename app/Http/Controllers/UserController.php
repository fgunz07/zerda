<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Skill;
use App\Location;
use App\Education;
use App\Profile;
use App\Specialization;
use App\User;  
use App\Achievement; 
use Image;

class UserController extends Controller
{
    public function show(){
        $skills = Skill::all();
        $specializations = Specialization::where('user_id',Auth::user()->id)->get();
        $userName = User::where('id',Auth::user()->id)->get(['last_name','first_name','middle_name']);
        // dd($userName);
        return view('pages.profile.show', array('user' => Auth::user()))
                ->with('skills',$skills)
                ->with('specializations',$specializations)
                ->with('userName',$userName);
            
    }

    public function dataProfile(){
        
        $education = Education::where('user_id',Auth::user()->id)->get();
        $locations = Location::where('user_id',Auth::user()->id)->get();
        $skills = Specialization::where('user_id',Auth::user()->id)->with('sklill_desc')->get();
        $achievement = Achievement::where('user_id',Auth::user()->id)->get();
       
        // dd($specializations);

        return response()->json(['education'=>$education,'locations'=>$locations,'skills'=>$skills,'achievement'=>$achievement]);
    }

    public function uploadProfile(Request $request){

        // Logic for user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(128, 128)->save( public_path('/uploads/avatars/' . $filename ) );
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return redirect('profile-show');

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
     
        $skill = new Specialization;
        $skill->user_id = Auth::user()->id;
        $skill->name = $request->name;

        $skill->save();
    }

    public function deleteSkill($id){
        // dd($id);
        Specialization::find($id)->delete();
        // return redirect('profile-show');
    }

    public function updateAchievement(Request $request){
        $achievement = new Achievement();
        $achievement->user_id = Auth::user()->id;
        $achievement->name = $request->name;
        $achievement->description = $request->description;
        $achievement->year_start = $request->year_start;
        $achievement->year_end = $request->year_end;
        $achievement->save();

        return redirect('profile-show');
    }

    public function deleteAchievement($id){
        // dd($id);
        Achievement::find($id)->delete();
        // return redirect('profile-show');
    }

    public function availableUsers(Request $request) {

        $users = User::where('status', 0)
                    ->role(['Senior Developer','Developer'])
                    ->get();

        foreach($users as $user) {

            if(!is_null($user->child_user_skill)) {

                foreach($user->child_user_skill as $skill) {

                    $user['skill'] += $skill;

                }

            };

        }

        return response()->json($users);

    }
}
