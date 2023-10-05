<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_name',255)->nullable();
            $table->string('doctor_address',255)->nullable();
            $table->string('hospital_name',255)->nullable();
            $table->string('hospital_address',255)->nullable();
            $table->string('contact_no_1',20)->nullable();
            $table->string('contact_no_2',20)->nullable();
            $table->string('email',255)->nullable();
            $table->unsignedBigInteger('employee')->nullable();
            $table->foreign('employee')->references('id')->on('employees');
            $table->unsignedBigInteger('qualification')->nullable();
            $table->foreign('qualification')->references('id')->on('qualifications');
            $table->unsignedBigInteger('category')->nullable();
            $table->foreign('category')->references('id')->on('categories');
            $table->unsignedBigInteger('territory')->nullable();
            $table->foreign('territory')->references('id')->on('territories');
            $table->string('state',20)->nullable();
            $table->string('city',20)->nullable();
            $table->string('speciality',20)->nullable();
            $table->string('designation',20)->nullable();
            $table->date('dob')->nullable();
            $table->date('dow')->nullable();
            $table->string('hq',20)->nullable();
            $table->string('class',20)->nullable();            
            $table->enum('type', ['ex', 'hq']);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
