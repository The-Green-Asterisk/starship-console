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
    public function up(): void
    {
        Schema::create('cargo_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('starship_id')->constrained('starships')->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('volume')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('price')->nullable();
            $table->boolean('on_board')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('cargo_items');
    }
};
