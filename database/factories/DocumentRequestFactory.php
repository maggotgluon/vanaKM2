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
            'Doc_Code' =>'DAR2022'.fake()->biasedNumberBetween(1000,9000),
            'Doc_Name' =>fake()->name(),
            'Doc_FullName' =>fake()->name(),
            'Doc_Type' =>'Document-DS_KM',
            'Doc_Obj' =>'ขอเอกสารใหม่',
            'Doc_Description' =>fake()->sentence(3),
            'Doc_Life' =>fake()->biasedNumberBetween(1,5),
            'Doc_ver' =>0,
            'Doc_StartDate' => fake()->dateTimeBetween('-10 week', '-1 week'),
            'Doc_Location' =>'/FilePDF/Mock/mock.pdf',
            'Doc_Status' =>0,
            'Doc_DateApprove' =>null,
            'User_Approve' =>null,
            'Access_Lv' =>null,
            'user_id' =>fake()->biasedNumberBetween(1,200)
        ];
    }
}
