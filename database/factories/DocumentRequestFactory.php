<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            'req_code'=>$this->faker->unique()->numerify('DAR2022####'),

            'req_obj'=>$this->faker->randomElement(['create','modify']),
            'req_description'=>$this->faker->paragraph(),
            'req_status'=>$this->faker->numberBetween(0,0),
            'req_remark'=>null,
            'access_Lv'=>null,

            'req_dateReview'=>null,
            'user_review'=>null,
            'req_dateApprove'=>null,
            'user_approve'=>null,

            'doc_code'=>$this->faker->unique()->numerify('ITD-###'),
            'doc_name'=>$this->faker->word(),
            'doc_type'=>'DS',
            'doc_life'=>$this->faker->numberBetween(1,10),
            'doc_ver'=>0,
            'pdf_location'=>'FilePDF/doc/mock/data.pdf',
            'doc_location'=>'FilePDF/doc/mock/data.docx',
            'doc_startDate'=>$this->faker->dateTimeBetween('-20 days','+20 days'),
            'created_at'=>$this->faker->dateTimeBetween('-60 days','-1 days'),
            'user_id'=>$this->faker->numberBetween(1,200),
        ];
    }
}
