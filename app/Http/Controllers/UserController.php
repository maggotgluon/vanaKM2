<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
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
        // dd($data, $user);
        $selectUser = user::find($user);
        switch ($data->update) {
            case 'department_head':
                $newDepartmentHead = user::where('staff_id',$data->suser)->first();
                $selectUser->department_head = $newDepartmentHead->name;
                $selectUser->save();
                break;
            case 'department':
                $selectUser->department = $data->department;
                $selectUser->save();
                break;
            case 'position':
                $selectUser->position = $data->position;
                $selectUser->save();
                break;
            case 'user_level':
                $selectUser->user_level = $data->user_level;
                $selectUser->save();
                break;
            case 'email':
                $selectUser->email = $data->email;
                $selectUser->save();
                break;
            default:
                # code...
                break;
        }
        
        return redirect(route('user.profile',$selectUser->id))->with('success', 'User update!');
    }

    public function changePassword(Request $request)
    {
        
         $request->validate([
            'current_password' => ['required',new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ],[
            
            'current_password' => 'password missmatch',
            'new_password' => 'password require',
            'new_confirm_password' => 'new password missmatch',
        ]
        );
        
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect(route('user.profile',User::find(auth()->user()->id)))->with('success', 'User update!');
    }
    
}
