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
    public function all(){
        return view('user.manage',['users'=>User::all()]);
    }

    public function mod_permission($user,$permission,$attach){
        // update permission of given user with option 
        dd($user,$permission,$attach);
        // DB::table('users_permissions')->updateOrInsert([
        //     'user_id' =>$user,
        //     'permissions_type' => 'permission',
        //     'parmission_name'=>$permission,
        // ],['allowance'=>$attach]);
    }

    public function update_user($user,$data){
        //update data of given user
    }
}
