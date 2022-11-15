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
            $table->string('req_code')->unique(); // Dar number

            $table->string('req_obj')->nullable();; // register objection
            $table->text('req_description')->nullable();;  // register discription

            $table->integer('req_status'); // status 0 pending 1 approved -1 reject
            $table->text('req_remark')->nullable(); // who approve
            $table->integer('access_Lv')->nullable(); // level of acess

            $table->dateTime('req_dateReview')->nullable(); //approved date
            $table->string('user_review')->nullable(); // who approve
            $table->dateTime('req_dateApprove')->nullable(); //approved date
            $table->string('user_approve')->nullable(); // who approve

            $table->string('doc_code'); // file name and document run number
            $table->string('doc_name'); // file name and document run number
            $table->string('doc_type'); // type of document
            $table->integer('doc_life')->nullable(); // document life  time
            $table->integer('doc_ver')->nullable(); // document version
            $table->string('pdf_location'); // file location
            $table->string('doc_location')->nullable(); // file location
            $table->dateTime('doc_startDate')->nullable(); // date start use -> default today

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
