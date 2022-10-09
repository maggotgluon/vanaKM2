<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
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

    public function permission($user,request $data,){
        // update permission of given user with option 
        // return dd($user,$data->permission,$data->allowance);
        $selectUser = user::find($user);
        // dd($selectUser->staff_id,$selectUser->userPermission);
        // $selectUser->userPermission->
        $allowance = $data->allowance==1?1:0;
        // dd($data->allowance,$allowance );
        DB::table('user_permissions')->updateOrInsert([
            'user_id' =>$user,
            'permissions_type' => 'permission',
            'parmission_name'=>$data->permission,
        ],['allowance'=>$allowance]);
        return redirect(route('user.profile',$selectUser->id))->with('success', 'Permission update!');
    }
    public function update(request $data,$user){
        // dd($data->suser, $user);
        $selectUser = user::find($user);
        $newDP = user::where('staff_id',$data->suser)->first();
            // dd($newDP->name,$selectUser);
            $selectUser->department_head = $newDP->name;
            $selectUser->save();
            return redirect(route('user.profile',$selectUser->id))->with('success', 'User update!');
    }
    
}
