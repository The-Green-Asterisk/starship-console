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
        //add job_id to cargo_items
        Schema::table('cargo_items', function (Blueprint $table) {
            $table->foreignId('job_id')->nullable()->constrained('jobs')->onDelete('cascade');
        });
        //add client_id to jobs
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
