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
        Schema::table('employer_profiles', function (Blueprint $table) {
            // Purane fields hatao
            if (Schema::hasColumn('employer_profiles', 'website')) {
                $table->dropColumn('website');
            }
            if (Schema::hasColumn('employer_profiles', 'logo')) {
                $table->dropColumn('logo');
            }

            // Naye fields add karo
            $table->string('address')->nullable()->after('company_name');
            $table->string('aadhar_card')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employer_profiles', function (Blueprint $table) {
            // Rollback ke liye wapas old fields
            $table->string('website')->nullable();
            $table->string('logo')->nullable();

            // Naye fields hatao
            $table->dropColumn(['address', 'aadhar_card']);
        });
    }
};
