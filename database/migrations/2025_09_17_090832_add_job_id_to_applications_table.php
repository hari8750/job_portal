<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            // Only add job_id if it doesn't exist
            if (!Schema::hasColumn('job_applications', 'job_id')) {
                $table->foreignId('job_id')
                      ->after('candidate_id')
                      ->constrained()
                      ->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            if (Schema::hasColumn('job_applications', 'job_id')) {
                $table->dropForeign(['job_id']);
                $table->dropColumn('job_id');
            }
        });
    }
};
