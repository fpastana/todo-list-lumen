<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $users = User::orderBy('id', 'desc')->with('todoNotes')->get();

        return response()->json($users);
    }

    public function show(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:App\Models\User,email|max:255',
            'password' => 'required|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 412);
        }

        $user_id = User::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(32),
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        $user = User::where('id', $user_id)->first();

        return response()->json($user, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => "required|email|unique:App\Models\User,email,$id,id|max:255",
            'password' => 'required|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 412);
        }

        $user_updated = User::where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

        $user = User::where('id', $id)->first();

        return (is_null($user)) ? response()->json(['No results found'], 404) : response()->json($user, 200);
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)
        ->delete();

        return response()->json($user);
    }
}
