<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Http\Request;
use Livewire\Component;

class UpdatePermissionsForm extends Component
{
    public $type;
    public $permission;
    public $role;

    public function updateType(){
        if($this->type == 'role'){
            $this->permission=[
                1,2,3
            ];
        }else{
            $this->permission=[
                ['name' => 'Approver', 'id' => '1'],
                ['name' => 'Reviewer', 'id' => '2']
            ];
        }
    }

    public function updatePermission(request $request){
        dd($this->role,$request);
    }

    public function add(Request $request){
        dd($request);
    }
    public function render()
    {
        return view('livewire.profile.update-permissions-form');
    }
}
