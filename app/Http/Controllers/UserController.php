<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json([
                'status' => true,
                'Message' => 'User Found!',
                'data' => $user
            ], 200);
        }
        return response()->json([
            'status' => false,
            'Message' => 'User Not Found!',
            'data' => ''
        ], 404);
    }


    public function profile(Request $request, $id)
    {
        if ($id != Auth::user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'You Can Edit This ' . $id
            ], 403);
        }
        $this->validate($request, [
            'name' => $request->name ? 'required' : '',
            'email' => $request->email ? 'required|unique:users|email:dns' : '',
            'password' => $request->password ? 'required|min:8' : '',
        ]);
        $user = User::find($id);
        $user->email = $request->email ? $request->email : $user->email;
        $user->name = $request->name ? $request->name : $user->name;
        $user->password = $request->password ? Hash::make($request->password) : Hash::make($user->password);
        $user->save();
        return response()->json([
            'status' => true,
            'Message' => 'Profile Updated',
            'data' => $user
        ], 200);
    }
}
