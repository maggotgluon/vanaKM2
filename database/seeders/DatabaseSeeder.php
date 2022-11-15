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
        // \App\Models\User::factory(10)->create();
        // \App\Models\DocumentRequest::factory(100)->create();
        // \App\Models\TrainingRequest::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'ruttaphong.w@vananava.com',
        //     'staff_id' => 'vn433',
        // ]);


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
                    'status'=> 1,
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);


        \App\Models\UserPermission::create([
            'user_id'=>103,
            'permissions_type'=>'role',
            'parmission_name'=>'admin',
            'allowance'=>1
        ]);
    }
}
