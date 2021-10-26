<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
}
