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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();

            // ✅ Basic admin fields
            $table->string('name'); 
            $table->string('email')->unique();
            $table->string('password');

            // ✅ Optional: role/status if you plan multiple admin types
            $table->enum('role', ['superadmin', 'admin'])->default('admin');
            $table->boolean('status')->default(true); // active/inactive

            // ✅ Laravel default
            $table->rememberToken(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
