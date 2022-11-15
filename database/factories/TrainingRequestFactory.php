<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainingRequest>
 */
class TrainingRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $subject =$this->faker->word();
        $LDS008 = array(
            'subject' => $subject,
            'train_dateStart' => $this->faker->date(),
            'train_dateEnd' => $this->faker->date(),
            'train_timeStart' => $this->faker->time('H:i'),
            'train_timeEnd' => $this->faker->time('H:i'),
            'train_objective' => $this->faker->paragraph(2, false),
            'train_subjectDetails' => $this->faker->paragraph(2, false),
            'train_subjectDuration' => $this->faker->numberBetween(10,60),
            // 'SubjectMaterial' => $this->faker->word(),
            // 'SubjectRemark' => $this->faker->word(),
            'train_activityDetails' => $this->faker->paragraph(2, false),
            'train_activityDuration' => $this->faker->numberBetween(10,60),
            // 'ActivityMaterial' => $this->faker->word(),
            // 'ActivityRemark' => $this->faker->word(),
            'train_assessmentDetails' => $this->faker->paragraph(2, false),
            'train_assessmentDuration' => $this->faker->numberBetween(10,60),
            // 'AssessmentMaterial' => $this->faker->word(),
            'train_remark' => $this->faker->paragraph(3, false),

        );
        $LDS009 = array(
            'subject' => $subject,
            'assessment_process' => $this->faker->paragraph(2, false),
            'assessment_tools' => $this->faker->word(),
            'assessment_pass' => $this->faker->paragraph(2, false),
            'assessment_fail' => $this->faker->paragraph(2, false),
        );


        $LDS008 = json_encode($LDS008);
        $LDS009 = json_encode($LDS009);

        return [

            'training_code' => $this->faker->unique()->numerify('TRAIN2022####'),
            'instructor' => $this->faker->numberBetween(1,200),
            'training_008' => $LDS008,
            'training_009' => $LDS009,
            'training_dateApprove' =>null,
            'user_approve' =>null,
            'training_dateReview' =>null,
            'user_review' =>null,
            'access_lv' =>null,

            'pdf_location' => 'FilePDF/doc/mock/data.pdf',
            'training_status' => $this->faker->numberBetween(-1,2),
            'user_id' => $this->faker->numberBetween(1,200),
            'remark' => null,
        ];
    }
}
