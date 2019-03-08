<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BoardsController extends Controller
{
    public function index() {

        $boards = auth()->user()->boards;

        return response()->json(['status' => true , 'data' => $boards]);

    }

    public function store(Request $request) {

        $data = $request->toArray();
        $rules= [
            'title' => 'unique:boards'
        ];
        $messages = [
            'title.unique' => 'Board name already exist.'
        ];
        $validate = Validator::make($data , $rules, $messages);
        if($validate->fails()) {
            return response()->json(['status' => false , 'message' => $validate->errors()] ,422);
        }

        try {

            $board = Board::create($request->all());

            DB::table('user_board')
                ->insert([
                    'user_id' => auth()->user()->id,
                    'board_id'=> $board->id
                ]);

            foreach($request->tags as $tag) {

                DB::table('board_skill')
                    ->insert([
                        'board_id' => $board->id,
                        'skill_id' => $tag
                    ]);

            }

        } catch (Exception $e) {

            return response()->json(['status' => false , 'message' => $e->getMessage()], 500);

        }

        return response()->json(['status' => true , 'message' => 'Board save.']);

    }

    public function show($id) {

        $board = Board::findOrFail($id);

        return view('apps.todolistApp.pages.show')
                    ->with('board', $board);

    }

    public function delete($id) {

        Board::findOrFail($id)->delete();

        return response()->json(['status' => true , 'message' => 'Board has been deleted.']);

    }

    public function boardDetails(Request $request, $id) {

        $board = Board::findOrFail($id);

        // auth()->user()->unreadNotifications->find($request->notf_id)->markAsRead();

        return view('apps.todolistApp.pages.details')
                ->with('board', $board)
                ->with('notf_id', $request->notf_id);

    }

    public function getSiniorDevs($id) {
        $board = Board::findOrFail($id);
        $users = [];
        foreach($board->users as $user) {
            if($user->hasRole(['Senior Developer'])) {
                $users[] = ['id' => $user->id , 'name' => $user->first_name.' '.$user->last_name];
            }
        }

        return response()->json($users);
    }

    public function saveSeniorDevs(Request $request) {
        $board = Board::findOrFail($request->board_id);
        $board->senior_developer = implode(',',$request->name);
        $board->save();

        return response()->json(['message' => 'Success']);
    }

    public function markCompleted($id) {

        $board = Board::findOrFail($id);
        $board->completed = 1;
        $board->save();

        return response()->json(['message' => 'Success']);

    }
}
