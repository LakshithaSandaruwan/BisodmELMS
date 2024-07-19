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
        Schema::table('homework_submitions', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('homework_id'); 
            $table->foreign('homework_id')->references('id')->on('homework')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homework_submitions', function (Blueprint $table) {
            //
        });
    }
};
