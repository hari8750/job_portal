<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id'); // user id
            $table->unsignedBigInteger('job_id');       // job id
            $table->enum('status', ['applied', 'shortlisted', 'hired', 'rejected'])->default('applied');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('job')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
};

