<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_requests', function (Blueprint $table) {
            $table->id();
            $table->string('training_code'); // Dar number
            $table->string('instructor')->nullable(); // Dar number
            $table->string('subject_code')->nullable(); // Dar number
            $table->json('training_008'); // Decsciption Document 008
            $table->json('training_009'); // Decsciption Document 009
            $table->datetime('training_dateApprove')->nullable(); //approved date
            $table->string('user_approve')->nullable(); // who approve
            $table->datetime('training_dateReview')->nullable(); //approved date
            $table->string('user_review')->nullable(); // who approve
            $table->integer('access_lv')->nullable(); // level of acess

            $table->timestamps();

            $table->string('pdf_location'); // file location
            $table->integer('training_status'); // status 0 pending 1 approved -1 reject

            $table->foreignId('user_id');
            $table->string('remark')->nullable(); // who approve
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_requests');
    }
};
