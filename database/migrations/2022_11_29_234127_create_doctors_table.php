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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_name',30);
            $table->text('address');
            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id')->references('id')->on('district_lists');
            $table->unsignedBigInteger('headquarter_id');
            $table->foreign('headquarter_id')->references('id')->on('headquarters');
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->unsignedBigInteger('specialization_id');
            $table->foreign('specialization_id')->references('id')->on('specializations');
            $table->unsignedBigInteger('pharmacy_id')->default(0);
            $table->string('medicine_id',50)->nullable();
            $table->text('information')->nullable();
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
        Schema::dropIfExists('doctors');
    }
};
