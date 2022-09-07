<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    // Profile
    public function profile($uid){
        // dd(User::where('department',User::find($uid)->department)->get());
        return view('user.profile',['user'=>User::find($uid),'dp'=>User::where('department',User::find($uid)->department)->get()]);
    }
    // manage permission
    public function manage(){
        return view('user.manage',['users'=>User::all()]);
    }
}
