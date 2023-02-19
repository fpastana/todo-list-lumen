<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

use App\Models\TodoNote;

use Auth;

class TodoNoteController extends Controller
{
    public function index()
    {
        $todo_notes = TodoNote::where('user_id', Auth::User()->id)->orderBy('id', 'desc')->get();

        return response()->json($todo_notes);
    }

    public function indexUser($user_id)
    {
        $todo_notes = TodoNote::where('user_id', $user_id)->orderBy('id', 'desc')->get();

        return response()->json($todo_notes);
    }

    public function show(Request $request, $id)
    {
        $todo_note = TodoNote::where('id', $id)->first();

        return response()->json($todo_note);
    }

    public function store(Request $request)
    {
        $request->request->add(['user_id' => Auth::User()->id]);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'content' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 412);
        }

        $todo_note_id = TodoNote::insertGetId([
            'user_id' => Auth::User()->id,
            'content' => $request->content,
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        $todo_note = TodoNote::where('id', $todo_note_id)->first();

        return response()->json($todo_note, 200);
    }

    public function destroy($id)
    {
        $todo_note = TodoNote::where('id', $id)->first();
        if(is_null($todo_note)){
            return response()->json([]);
        }

        if(Auth::User()->id === $todo_note->user_id){
            $delete = TodoNote::where('id', $id)
                ->delete();
            return response()->json($delete);
        } else {
            return response()->json(['Error' => 'You do not have permission to perform this operation'], 412);
        }
    }

    public function markAsComplete(Request $request, $id)
    {
        $todo_note = TodoNote::where('id', $id)->first();
        if(is_null($todo_note)){
            return response()->json([]);
        }

        if(Auth::User()->id === $todo_note->user_id){
            $todo_note_updated = TodoNote::where('id', $id)
                ->update([
                    'completion_time' => \Carbon\Carbon::now(),
                ]);

            $todo_note = TodoNote::where('id', $id)->first();

            return response()->json($todo_note, 200);
        } else {
            return response()->json(['Error' => 'You do not have permission to perform this operation'], 412);
        }
    }

    public function markAsIncomplete(Request $request, $id)
    {
        $todo_note = TodoNote::where('id', $id)->first();
        if(is_null($todo_note)){
            return response()->json([]);
        }

        if(Auth::User()->id === $todo_note->user_id){
            $todo_note_updated = TodoNote::where('id', $id)
                ->update([
                    'completion_time' => null,
                ]);

            $todo_note = TodoNote::where('id', $id)->first();

            return response()->json($todo_note, 200);
        } else {
            return response()->json(['Error' => 'You do not have permission to perform this operation'], 412);
        }
    }
}
