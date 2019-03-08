<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Log;
use Auth;
use App\Skill;
use App\Location;
use App\Education;
use App\Profile;
use App\Specialization;
use App\User;  
use App\Achievement; 
use App\Board;
use Image;

class UserController extends Controller
{

    public function profile() 
    {

        $skills = Skill::all();
        $roles  = Role::all();

        return view('pages.profile.profile')
                    ->with('skills', $skills)
                    ->with('roles', $roles);

    }

    public function addSkill(Request $request) 
    {

        // $data   = $request->toArray();

        // $rules  = [

        //     'skills' => ''
        // ]; 

        // Validator::make($data , $rules , $messages);

        try {

            if(!is_null($request->skills)) {

                DB::table('user_skill')->where('user_id', auth()->user()->id)->delete();

                foreach($request->skills as $skill) {

                    DB::table('user_skill')->insert(['user_id' => auth()->user()->id, 'skill_id' => $skill]);

                }

            }

        } catch (Exception $e) {

            return response()->json(['status' => false , 'message' => $e->getMessage()], 500);

        }

        return response()->json(['status' => true , 'message' => auth()->user()->skills]);

    }

    public function addRole(Request $request)
    {

        try {

            auth()->user()->assignRole($request->role);

        } catch (Exception $e) {

            return response()->json(['status' => false, 'message' => $getMessage()], 500);

        }

        return response()->json(['status' => true , 'message' => 'Role assigned.']);


    }

    public function updateEducation(Request $request)
    {
        
        try {

            $user                                   = User::find(auth()->user()->id);
            $user->primary_edication_full_details   = $request->primary;
            $user->secondary_edication_full_details = $request->secondary;
            $user->teriary_edication_full_details   = $request->tertiary;
            $user->save();

        } catch(Exception $e) {

            return response()->json(['status' => false , 'message' => $e->getMessage()], 500);

        }

        return response()->json(['status' => true , 'message' => 'Updated.']);
        
    }

    public function updateLocation(Request $request)
    {

        try {

            $user            = User::find(auth()->user()->id);
            $user->address   = $request->street.', '.$request->brgy.', '.$request->city.', '.$request->province.', '.$request->country;
            $user->save();

        } catch(Exception $e) {

            return response()->json(['status' => false , 'message' => $e->getMessage()], 500);

        }

        return response()->json(['status' => true , 'message' => 'Updated.']);

    }

    public function updatePortfolio(Request $request) 
    {

        try {

            $user            = User::find(auth()->user()->id);
            $user->portfolio = $request->portfolio;
            $user->save();

        } catch(Exception $e) {

            return response()->json(['status' => false , 'message' => $e->getMessage()], 500);

        }

        return response()->json(['status' => true , 'message' => 'Updated.']);

    }

    public function updateAchievement(Request $request) 
    {

        try {

            $achievement            = new Achievement;
            $achievement->name      = $request->name;
            $achievement->user_id   = auth()->user()->id;
            $achievement->year_Start= $request->start;
            $achievement->year_end  = $request->end;
            $achievement->description= $request->description;
            $achievement->save();

        } catch(Exception $e) {

            return response()->json(['status' => false , 'message' => $e->getMessage()], 500);

        }

        return response()->json(['status' => true , 'message' => 'Achievement save.']);
    }

    public function getAchievement($id) 
    {

        $achievement = Achievement::find($id);

        return response()->json($achievement);

    }

    public function putAchievement(Request $request, $id)
    {

        try {

            $achievement = Achievement::find($id);
            $achievement->name      = $request->name;
            $achievement->year_Start= $request->start;
            $achievement->year_end  = $request->end;
            $achievement->description= $request->description;
            $achievement->save();

        } catch(Exception $e) {

            return response()->json(['status' => false , 'message' => $e->getMessage()], 500);

        }

        return response()->json(['status' => true]);

    }

    public function uploadImg(Request $request)
    {

        $filename   = str_random(40);

        $ext        = $request->img->getClientOriginalExtension(); 

        if($request->hasFile('img')) {

            $user = User::find(auth()->user()->id);
            $user->avatar_url = "images/{$filename}.{$ext}";
            $user->save();

            $request->img->move(public_path('images'), $filename.'.'.$ext);

            return response()->json(['messge' => url("images/{$filename}.{$ext}")]);

        }

        return response()->json(['message'=>'no file'], 404);

    }

    public function availableUsers(Request $request) {

        $board = Board::findOrFail($request->board);

        $users = User::where('status', 0)
                    ->role(['Senior Developer','Developer'])
                    ->with('roles')
                    ->whereHas('skills', function($query) use ($board) {

                        // if(!is_null($board->tags)) {

                            

                        // }

                        $t = [];

                        foreach ($board->tags as $tag) {

                            $t[] = $tag->name;

                        }

                        $query->whereIn('name', $t)
                                ->groupBy('name')
                                ->orderBy('name');

                    })
                    ->get();
    
        foreach($users as $user) {
            if(!is_null($user)) {
                
                foreach($user->skills as $skill) {

                    $user['skill'] .= "<small class='{$skill->class}'>{$skill->name}</small>&nbsp;";
                
                }
            };
        }

        $users->sortBy(function($items) {
            return $items->boards->count();
        })
        ->sortBy(function($items) {
            return $items->skills->count();
        })
        ->sortBy(function($items) {
            return $items->achievements->count();
        });

        return response()->json($users);
    }
}
