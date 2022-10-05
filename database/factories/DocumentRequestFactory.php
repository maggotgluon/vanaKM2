<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document_Request>
 */
class DocumentRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'Doc_Code' =>fake()->name(),
            'Doc_Name' =>fake()->name(),
            'Doc_Type' =>fake()->name(),
            'Doc_Obj' =>fake()->name(),
            'Doc_Description' =>fake()->name(),
            'Doc_Life' =>1,
            'Doc_ver' =>0,
            'Doc_StartDate' => now(),
            'Doc_Location' =>'/FilePDF/IDT-002-0',
            'Doc_Status' =>0,
            'Doc_DateApprove' =>0,
            'User_Approve' =>null,
            'Access_Lv' =>null,
            'user_id' =>106
        ];
    }
}
