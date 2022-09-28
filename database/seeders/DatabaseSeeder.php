<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //id 1
        \App\Models\User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'staff_id'=>'test',
            'department'=>'IT',
            'position'=>'test',
            'department_head'=>'Suwat',
            'user_level'=>'1',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        // User id 2
        \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@test.com',
            'staff_id'=>'user',
            'department'=>'test',
            'position'=>'test',
            'department_head'=>'VN433',
            'user_level'=>'staff',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        // Advance User id 3
        \App\Models\User::factory()->create([
            'name' => 'useradv',
            'email' => 'useradv@test.com',
            'staff_id'=>'useradv',
            'department'=>'test',
            'position'=>'test',
            'department_head'=>'VN433',
            'user_level'=>'staff',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        // KM Manager id 4
        \App\Models\User::factory()->create([
            'name' => 'managerkm',
            'email' => 'managerkm@test.com',
            'staff_id'=>'managerkm',
            'department'=>'test',
            'position'=>'test',
            'department_head'=>'VN433',
            'user_level'=>'staff',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        // Training Manager id 5
        \App\Models\User::factory()->create([
            'name' => 'managertr',
            'email' => 'managertr@test.com',
            'staff_id'=>'managertr',
            'department'=>'test',
            'position'=>'test',
            'department_head'=>'VN433',
            'user_level'=>'staff',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        // MD id 6
        \App\Models\User::factory()->create([
            'name' => 'md',
            'email' => 'md@test.com',
            'staff_id'=>'md',
            'department'=>'test',
            'position'=>'test',
            'department_head'=>'VN433',
            'user_level'=>'staff',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        // Admin id 7
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'staff_id'=>'admin',
            'department'=>'test',
            'position'=>'test',
            'department_head'=>'VN433',
            'user_level'=>'staff',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        // \App\Models\User::factory(10)->create();


        //
        \App\Models\users_permission::factory()->create([
            'user_id' => 3,
            'permissions_type' => 'role',
            'parmission_name'=>'admin',
            'allowance'=>1,
        ]);
        \App\Models\users_permission::factory()->create([
            'user_id' => 4,
            'permissions_type' => 'role',
            'parmission_name'=>'adminKM',
            'allowance'=>1,
        ]);
        \App\Models\users_permission::factory()->create([
            'user_id' => 5,
            'permissions_type' => 'role',
            'parmission_name'=>'adminTraining',
            'allowance'=>1,
        ]);
        \App\Models\users_permission::factory()->create([
            'user_id' => 6,
            'permissions_type' => 'role',
            'parmission_name'=>'adminMD',
            'allowance'=>1,
        ]);
        
        //permission
        \App\Models\users_permission::factory()->create([
            'user_id' => 3,
            'permissions_type' => 'permission',
            'parmission_name'=>'addKM',
            'allowance'=>1,
        ]);
        \App\Models\users_permission::factory()->create([
            'user_id' => 3,
            'permissions_type' => 'permission',
            'parmission_name'=>'addTraining',
            'allowance'=>1,
        ]);

        // seed from file
        $csvFile = fopen(base_path("database/data/user.csv"), "r");
        
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                \App\Models\User::factory()->create([
                    'name' => $data['1'],
                    'email' => $data['2'],
                    'staff_id'=> $data['3'],
                    'department'=> $data['4'],
                    'position'=> $data['5'],
                    'department_head'=> $data['7'],
                    'user_level'=> $data['6'],
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
