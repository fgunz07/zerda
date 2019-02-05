<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use Illuminate\Support\Facades\DB;

class BoardsController extends Controller
{
    public function index() {

        $boards = auth()->user()->boards;

        return response()->json(['status' => true , 'data' => $boards]);

    }

    public function store(Request $request) {

        try {

            $board = Board::create($request->all());

            DB::table('user_board')
                ->insert([
                    'user_id' => auth()->user()->id,
                    'board_id'=> $board->id
                ]);

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
}
