<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
// use RealRashid\SweetAlert\Facades\Alert;
class UserController extends Controller
{
    public function all($filter = null, request $data=null){
        // dd($data);
        // alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');
        return view('user.index',['users'=>User::all()]);
    }
    public function allFiltter(request $data){
        $user = User::all();

        if($data->department!=null){
            $user = $user->where('department',$data->department);
            // dd($user);
        }else if($data->level!=null){
            $user = $user->where('user_level',$data->level);
        }else{
            $user = User::all();
        }
        // dd($user);
        // alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');
        return view('user.index',['users'=>$user,'data'=>$data]);
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
        $action = $allowance==1?'add':'removed';
        // dd($data->allowance,$allowance );
        DB::table('user_permissions')->updateOrInsert([
            'user_id' =>$user,
            'permissions_type' => $data->permissions_type,
            'parmission_name'=>$data->permission,
        ],['allowance'=>$allowance]);

        Log::channel('user')->info(Auth::user()->name .' '.$action.' '.$data->permissions_type.' '.$data->permission.' of '. $selectUser->name);
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
        Log::channel('user')->info(Auth::user()->name .' update '.$data->update.' of '. $selectUser->name);
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
        Log::channel('user')->info(Auth::user()->name .' update password');
        return redirect(route('user.profile',User::find(auth()->user()->id)))->with('success', 'User update!');
    }

}
