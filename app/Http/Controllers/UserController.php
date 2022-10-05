<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;
class UserController extends Controller
{
    public function all(){
        // alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');
        return view('user.index',['users'=>User::all()]);
    }

    public function profile($uid){
        $user = User::find($uid);
        $userDepartmentHead = User::where('department',User::find($uid)->department)->get();
        // alert()->error('Error Title', 'Error Message');
        return view('user.profile',['user'=>$user,'dp'=>$userDepartmentHead]);
    }
    
}
