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
        Schema::create('homework_submitions', function (Blueprint $table) {
            $table->id();
            $table->string('Submision_file_path');
            $table->unsignedBigInteger('student_id'); 
            $table->unsignedBigInteger('subject_id'); 
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('subject_mappings')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homework_submitions');
    }
};
