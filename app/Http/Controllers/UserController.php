<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    // Profile
    public function profile($uid){
        
        return view('user.profile',['user'=>User::find($uid)]);
    }
    // manage permission
    public function manage(){
        return view('user.manage',['users'=>User::all()]);
    }
}
