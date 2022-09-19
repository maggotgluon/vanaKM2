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
        Schema::create('train_requests', function (Blueprint $table) {
            
            $table->id();
            $table->string('Doc_Code'); // Dar number
            $table->json('Doc_008'); // Decsciption Document 008
            $table->json('Doc_009'); // Decsciption Document 009
            $table->string('Doc_DateApprove')->nullable(); //approved date
            $table->string('User_Approve')->nullable(); // who approve
            $table->integer('Access_Lv')->nullable(); // level of acess
            $table->timestamps();
            $table->string('Doc_Location'); // file location
            $table->integer('Doc_Status'); // status 0 pending 1 approved -1 reject
            
            $table->foreignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('train_requests');
    }
};
