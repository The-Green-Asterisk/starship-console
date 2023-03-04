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
        Schema::create('cargo_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('volume')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('price')->nullable();
            $table->foreignId('job_id')->constrained('jobs')->nullable()->onDelete('cascade');
            $table->boolean('on_board')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargo_items');
    }
};
