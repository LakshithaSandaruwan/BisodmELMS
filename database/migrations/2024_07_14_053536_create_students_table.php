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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('initial');
            $table->string('LastName');
            $table->string('FullName');
            $table->string('Gender');
            $table->string('birthday');
            $table->string('school');
            $table->string('city');
            $table->string('grade');
            $table->string('contactNumber');
            $table->string('email');
            $table->string('houseNumber');
            $table->string('street');
            $table->string('district');
            $table->string('province');
            $table->string('PerentFullName');
            $table->string('PerentGender');
            $table->string('PerentNic');
            $table->string('PerentContact');
            $table->string('PerentEmail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
