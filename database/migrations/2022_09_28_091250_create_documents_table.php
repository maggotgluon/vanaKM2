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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Doc_Code')->unique(); // Dar number
            $table->string('Doc_Name'); // file name and document run number
            $table->string('Doc_Type'); // type of document
            $table->date('Doc_StartDate')->nullable(); // document life  time
            $table->integer('Doc_Life'); // document life  time
            $table->integer('Doc_ver'); // document version
            $table->string('Doc_Location')->nullable(); // file location
            $table->date('Doc_DateApprove')->nullable(); //approved date
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
