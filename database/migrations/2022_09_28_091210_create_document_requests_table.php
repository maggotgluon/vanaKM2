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
        Schema::create('document_requests', function (Blueprint $table) {
            $table->id();
            $table->string('Doc_Code')->unique(); // Dar number
            $table->string('Doc_Name'); // file name and document run number
            $table->string('Doc_FullName')->nullable(); // file name and document run number

            $table->string('Doc_Type'); // type of document
            $table->string('Doc_Obj'); // register objection
            $table->text('Doc_Description');  // register discription
            $table->integer('Doc_Life'); // document life  time 
            $table->integer('Doc_ver'); // document version
            
            $table->date('Doc_StartDate'); // date start use -> default today
            $table->string('Doc_Location'); // file location
            $table->integer('Doc_Status'); // status 0 pending 1 approved -1 reject
            $table->date('Doc_DateApprove')->nullable(); //approved date
            $table->string('User_Approve')->nullable(); // who approve
            $table->date('Doc_DateMRApprove')->nullable(); //approved date
            $table->string('User_MRApprove')->nullable(); // who approve
            $table->string('Remark')->nullable(); // who approve
            $table->integer('Access_Lv')->nullable(); // level of acess
            $table->timestamps();
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
        Schema::dropIfExists('document_requests');
    }
};
