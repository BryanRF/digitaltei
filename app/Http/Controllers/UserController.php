<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function checkPassword($password)
    {
        $valid = Hash::check($password, Auth::user()->password);
        return response()->json(['valid' => $valid]);
        // return response()->json(['valida' => 'Hola mundo']);
    }
}
