<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\users_permission;
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
        // // Should return TRUE or FALSE
        Gate::define('edit_document', function(User $user) {
            // can upload KM request
            boo:$can=false;
            
            foreach($user->users_permission as $permission){
                if($permission->parmission_name=='edit_document'&$permission->allowance==1){
                    $can=true;
                    return $can;
                }

                if($permission->parmission_name=='admin'&$permission->allowance==1){
                    $can=true;
                    return $can;
                }
            }
            
            if($user->user_level=='Supervisor'||$user->user_level=='Assistant Manager'||$user->user_level=='Manager'||$user->user_level=='Director'||$user->user_level=='MR'){
                $can=true;
                return $can;
            }
            return $user->is_admin == 1 | $can;
        });
        Gate::define('edit_trainDocument', function(User $user) {
            // can upload Training request
            boo:$can=false;
            foreach($user->users_permission as $permission){
                if($permission->parmission_name=='edit_trainDocument'&$permission->allowance==1){
                    $can=true;
                    return $can;
                }
                if($permission->parmission_name=='admin'&$permission->allowance==1){
                    $can=true;
                    return $can;
                }
            }

            if($user->user_level=='Supervisor'||$user->user_level=='Assistant Manager'||$user->user_level=='Manager'||$user->user_level=='Director'||$user->user_level=='MR'){
                $can=true;
                return $can;
            }
            return $user->is_admin == 1 | $can;
        });

        // management level 
        Gate::define('manage_document', function(User $user) {
            // can manage KM request
            boo:$can=false;
            foreach($user->users_permission as $permission){
                if($permission->parmission_name=='manage_document'&$permission->allowance==1){
                    $can=true;
                    return $can;
                }
                if($permission->parmission_name=='admin'&$permission->allowance==1){
                    $can=true;
                    return $can;
                }
            }
            return $user->is_admin == 1 | $can;
        });
        Gate::define('manage_trainDocument', function(User $user) {
            // can manage Training request
            boo:$can=false;
            foreach($user->users_permission as $permission){
                if($permission->parmission_name=='manage_trainDocument'&$permission->allowance==1){
                    $can=true;
                    return $can;
                }
                if($permission->parmission_name=='admin'&$permission->allowance==1){
                    $can=true;
                    return $can;
                }
            }
            return $user->is_admin == 1 | $can;
        });
        Gate::define('manage_users', function(User $user) {
            // can manage user row/permission
            boo:$can=false;
            foreach($user->users_permission as $permission){
                if($permission->parmission_name=='manage_users'&$permission->allowance==1){
                    $can=true;
                    return $can;
                }
                if($permission->parmission_name=='admin'&$permission->allowance==1){
                    $can=true;
                    return $can;
                }
            }
            return $user->is_admin == 1 | $can;
        });

        // MD level
        Gate::define('publish_document', function(User $user) {
            // can Approved KM request (MD)
            boo:$can=false;
            foreach($user->users_permission as $permission){
                if($permission->parmission_name=='publish_document'&$permission->allowance==1){
                    $can=true;
                    return $can;
                }
                if($permission->parmission_name=='admin'&$permission->allowance==1){
                    $can=true;
                    return $can;
                }
            }
            if($user->user_level=='MR'){
                $can=true;
                return $can;
            }
            return $user->is_admin == 1 | $can;
        });

    }
}
