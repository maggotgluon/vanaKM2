<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Gate::define('edit_document', function(User $user) {
            // can upload KM request

            boo:$can=false;
            // dd($user->user_level);
            // $can = $user->user_level == 5?false:true;
            // 2,3,4,5,6,7,99
            $can = $user->user_level >= 2 || $user->user_level == 99||$user->permissions->where('allowance',1)->contains('parmission_name','admin');

            // foreach($user->permissions as $permission){
            //     if($permission->parmission_name=='edit_document'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }

            //     if($permission->parmission_name=='admin'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            // }

            // if($user->user_level=='Supervisor'||$user->user_level=='Assistant Manager'||$user->user_level=='Manager'||$user->user_level=='Director'||$user->user_level=='MR'){
            //     $can=true;
            //     // return $can;
            // }
            return $can;
        });
        Gate::define('edit_trainDocument', function(User $user) {
            // can upload Training request
            boo:$can=false;
            // 2,3,4,5,6,7,99

            $can = $user->user_level >= 2 || $user->user_level == 99||$user->permissions->where('allowance',1)->contains('parmission_name','admin');
            // foreach($user->permissions as $permission){
            //     if($permission->parmission_name=='edit_trainDocument'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            //     if($permission->parmission_name=='admin'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            // }

            // if($user->user_level=='Supervisor'||$user->user_level=='Assistant Manager'||$user->user_level=='Manager'||$user->user_level=='Director'||$user->user_level=='MR'){
            //     $can=true;
            //     // return $can;
            // }
            return $can;
        });

        // management level
        Gate::define('review_document', function(User $user) {
            // can manage KM request
            boo:$can=false;
            // 6,7
            $can = $user->user_level == 6 || $user->user_level == 99||$user->permissions->where('allowance',1)->contains('parmission_name','admin');
            // foreach($user->permissions as $permission){
            //     if($permission->parmission_name=='review_document'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            //     if($permission->parmission_name=='admin'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            // }
            return $can;
        });
        Gate::define('review_trainDocument', function(User $user) {
            // can manage Training request
            boo:$can=false;
            // 4,5
            $can = $user->user_level == 4 || $user->user_level == 99||$user->permissions->where('allowance',1)->contains('parmission_name','admin');
            // foreach($user->permissions as $permission){
            //     if($permission->parmission_name=='review_trainDocument'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            //     if($permission->parmission_name=='admin'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            // }
            return $can;
        });
        Gate::define('manage_users', function(User $user) {
            // can manage user row/permission
            boo:$can=false;
            // 4,6
            $can = $user->user_level == 4 || $user->user_level == 6 || $user->user_level == 99||$user->permissions->where('allowance',1)->contains('parmission_name','admin');
            // foreach($user->permissions as $permission){
            //     if($permission->parmission_name=='manage_users'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            //     if($permission->parmission_name=='admin'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            // }
            return  $can;
        });

        // MD level
        Gate::define('publish_document', function(User $user) {
            // can Approved KM request (MD)

            boo:$can=false;
            $can = $user->user_level == 7 || $user->user_level == 99||$user->permissions->where('allowance',1)->contains('parmission_name','admin');
            // foreach($user->permissions as $permission){
            //     if($permission->parmission_name=='publish_document'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            //     if($permission->parmission_name=='admin'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            // }
            // if($user->user_level=='MR'){
            //     $can=true;
            //     // return $can;
            // }
            return $can;
        });
        // MD level
        Gate::define('publish_trainDocument', function(User $user) {
            // can Approved KM request (MD)

            boo:$can=false;
            $can = $user->user_level == 5 || $user->user_level == 99||$user->permissions->where('allowance',1)->contains('parmission_name','admin');
            // foreach($user->permissions as $permission){
            //     if($permission->parmission_name=='publish_document'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            //     if($permission->parmission_name=='admin'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            // }
            // if($user->user_level=='MR'){
            //     $can=true;
            //     // return $can;
            // }
            return $can;
        });


        Gate::define('reject_document', function(User $user){
            boo:$can=false;
            $can = $user->user_level == 99
                || $user->user_level == 5 || $user->user_level == 7
                || $user->permissions->where('allowance',1)->contains('parmission_name','admin');
            return $can;
        });

        Gate::define('reject_training', function(User $user){
            boo:$can=false;
            $can = $user->user_level == 4 || $user->user_level == 6 || $user->user_level == 99
                || $user->user_level == 5 || $user->user_level == 7
                || $user->permissions->where('allowance',1)->contains('parmission_name','admin');
            return $can;
        });

        Gate::define('view_log', function(User $user) {
            // can manage user row/permission
            boo:$can=false;

            $can = $user->user_level == 4 || $user->user_level == 6 || $user->user_level == 99||$user->permissions->where('allowance',1)->contains('parmission_name','admin');
            // foreach($user->permissions as $permission){
            //     if($permission->parmission_name=='view_log'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            //     if($permission->parmission_name=='admin'&$permission->allowance==1){
            //         $can=true;
            //         // return $can;
            //     }
            // }
            return $can;
        });
    }
}
