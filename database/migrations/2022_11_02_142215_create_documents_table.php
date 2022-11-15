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
            $table->string('req_code');
            $table->foreignId('req_id'); // Dar number

            $table->string('doc_code'); // Dar number
            $table->string('doc_name'); // file name and document run number
            $table->string('doc_type'); // type of document
            $table->dateTime('doc_startDate'); // document life  time
            $table->integer('doc_life'); // document life  time
            $table->integer('doc_ver'); // document version
            $table->string('pdf_location'); // file location

            $table->dateTime('doc_dateApprove'); //approved date
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
