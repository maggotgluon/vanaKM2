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
            $table->string('Doc_Code')->unique(); // Dar number
            $table->json('Doc_008'); // Decsciption Document 008
            $table->json('Doc_009'); // Decsciption Document 009
            $table->date('Doc_DateApprove')->nullable(); //approved date
            $table->string('User_Approve')->nullable(); // who approve
            $table->date('Doc_DateReview')->nullable(); //approved date
            $table->string('User_Review')->nullable(); // who approve
            $table->integer('Access_Lv')->nullable(); // level of acess

            $table->timestamps();
            
            $table->string('Doc_Location'); // file location
            $table->integer('Doc_Status'); // status 0 pending 1 approved -1 reject

            $table->foreignId('user_id');
            $table->string('Remark')->nullable(); // who approve
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
