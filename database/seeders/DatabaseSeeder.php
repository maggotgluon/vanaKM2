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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
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
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                ]);    
            }
            $firstline = false;
        }
        fclose($csvFile);

        $csvFile = fopen(base_path("database/data/docrec.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                
                \App\Models\DocumentRequest::factory()->create([
                    'Doc_Code' => $data['1'],
                    'Doc_Name' => $data['2'],
                    'Doc_Type' => $data['3'],
                    'Doc_Obj' => $data['4'],
                    'Doc_Description' => $data['5'],
                    'Doc_Life' =>1,
                    'Doc_ver' => $data['7'],
                    'Doc_StartDate' => fake()->date(),
                    'Doc_Location' => $data['9'],
                    'Doc_Status' =>0,
                    'Doc_DateApprove' =>null,
                    'User_Approve' =>null,
                    'Doc_DateMRApprove' =>null,
                    'User_MRApprove' =>null,
                    'Access_Lv' =>null,
                    'user_id' => 106
                ]);    
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
