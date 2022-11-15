<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    //

    public function index(){
        $users = User::all();
        if(request()->department){
            $users = $users->where('department',request()->department);
        }
        if(request()->user_level){
            $users = $users->where('user_level',request()->user_level);
        }
        $users = $users->toQuery()->reorder('user_level','desc')->get();
        if(request()->id){
            $users = $users->toQuery()->reorder('staff_id',request()->id)->get();
        }

        return view('user.index',['users'=>$users->paginate(15)]);
    }
    public function search(Request $key){
        // dd($key->search);
        // dd($key->fullUrlWithQuery(['department'=>'department']));
        $users = User::where('name','like','%'.$key->search.'%')
                ->orWhere('staff_id', 'like','%'.$key->search.'%')
                ->orWhere('email', 'like','%'.$key->search.'%')
                ->orWhere('position', 'like','%'.$key->search.'%')
                ->orWhere('department', 'like','%'.$key->search.'%')
                    ->get();

        return view('user.index',['users'=>$users->paginate(15)]);
    }
    public function show($id){
        $user = User::find($id);
        return view('user.show',['user'=>$user]);
    }
    public function create(){
        return view('user.create');
    }

    public function register(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->name = $request->name;
        $user->staff_id = $request->staff_id;
        $user->position = $request->position;
        $user->department = $request->department;
        $user->user_level = $request->user_level;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // $user->password_confirmation = $request->password_confirmation;
        $user->save();
        dd($request,$user);
    }


    public function store(Request $request,$id = null){
        // dd($request);
        if($id){
            $user = User::find($id);
            // $user->id = $request->id;
            $user->name = $request->name;
            $user->staff_id = $request->staff_id;
            $user->department = $request->department;
            $user->department_head = $request->department_head;
            $user->position = $request->position;
            $user->user_level = $request->user_level;
            $user->status = $request->status?1:0;
            $user->email = $request->email;


            // $user->email_verified_at = $request->email_verified_at;
            // if($request->password){
                // dd($request->password);
                // $user->forceFill([
                //     'password' => Hash::make($request->password),
                // ])->save();
            // }
            // $user->two_factor_secret = $request->two_factor_secret;
            // $user->two_factor_recovery_codes = $request->two_factor_recovery_codes;
            // $user->remember_token = $request->remember_token;
            // $user->current_team_id = $request->current_team_id;
            // $user->profile_photo_path = $request->profile_photo_path;
            // $user->created_at = $request->created_at;
            // $user->updated_at = $request->updated_at;

            $user->save();


            // dd($user);
        }

        return redirect()->route('user.index');
    }
    public function permission(Request $request,$id = null){
        $user = $id?User::find($id):Auth::User();
        $allowance = $request->allowance==1?1:0;
        // $user->permissions
        // dd($request,$user);
        DB::table('user_permissions')->updateOrInsert([
            'user_id' =>$user->id,
            'permissions_type' => $request->permissions_type,
            'parmission_name'=>$request->permissions_name,
        ],['allowance'=>$allowance]);
        return redirect()->route('user.show',$user);
    }
}
