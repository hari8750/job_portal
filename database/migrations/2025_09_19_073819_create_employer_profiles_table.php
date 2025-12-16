<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('employer_profiles', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // link to users table
        $table->string('company_name');
        $table->string('website')->nullable();
        $table->text('description')->nullable();
        $table->string('logo')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    

    public function down()
    {
        Schema::dropIfExists('employer_profiles');
    }
};
