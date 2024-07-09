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
        Schema::create('spend_files', function (Blueprint $table) {
            $table->id();
            $table->string('fileName');
            $table->string('location');
            $table->unsignedBigInteger('spend_id');
            $table->foreign('spend_id')->references('id')->on('spends');
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
        Schema::dropIfExists('spend_files');
    }
};
