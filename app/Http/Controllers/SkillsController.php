<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;

class SkillsController extends Controller
{
    public function index(){
    	$data = Skill::all();
    	return view('pages.skills.index',compact('data'));
    }

    public function create(){
    	return view('pages.skills.create');
    }

    public function store(Request $request){
        // dd($request->all());
    	Skill::create($request->all());
        session()->flash('save', 'Record Successfully Saved.');
    	return redirect('skills-list');
    }

    public function edit($id){
    	$data = Skill::find($id);
        // dd($data);
    	return view('pages.skills.create')->with('data',$data);
    }

    public function update(Request $request, $id){
    	Skill::where('id', $id)->update($request->except(['_method', '_token']));
        session()->flash('edit', 'Record Successfully Edited.');
    	return redirect('skills-list');
    }

    public function destroy($id){
    	Skill::find($id)->delete();
    }
}
