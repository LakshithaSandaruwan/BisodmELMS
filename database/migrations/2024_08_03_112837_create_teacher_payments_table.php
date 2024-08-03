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
        Schema::create('teacher_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id'); 
            $table->date('month'); 
            $table->decimal('basic', 8, 2);
            $table->decimal('bonus', 8, 2);
            $table->decimal('insitute_pay', 8, 2);
            $table->decimal('taxes', 8, 2);
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_payments');
    }
};
