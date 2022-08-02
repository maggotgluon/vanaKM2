<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    // Profile
    public function profile(){
        return view('user.profile');
    }
    // manage permission
    public function manage(){
        return view('user.manage');
    }
}
