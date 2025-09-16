<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //tampilkan semua data user
        $users = User::all();
        return response()->json([
            'number_of_users' => $users->count(),
            'data' => $users
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' =>  'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'user created successfuly',
            'data' => $user
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //tampilkan data tertentu
        $user = User::find($id);
        if ($user){
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'User Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

    }
}
