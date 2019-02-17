<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ratingdesc;

class RatingsdescController extends Controller
{
    public function index(){
        $data = Ratingdesc::all();
        // dd($data);
    	return view('pages.ratings.index',compact('data'));
    }

    public function create(){
    	return view('pages.ratings.create');
    }

    public function store(Request $request){
        // dd($request->all());
    	Ratingdesc::create($request->all());
        session()->flash('save', 'Record Successfully Saved.');
    	return redirect('ratingdesc-list');
    }

    public function edit($id){
    	$data = Ratingdesc::find($id);
        // dd($data);
    	return view('pages.ratings.create')->with('data',$data);
    }

    public function update(Request $request, $id){
    	Ratingdesc::where('id', $id)->update($request->except(['_method', '_token']));
        session()->flash('edit', 'Record Successfully Edited.');
    	return redirect('ratingdesc-list');
    }

    public function destroy($id){
    	Ratingdesc::find($id)->delete();
    }
}
