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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('starship_id')->constrained()->nullable();
            $table->integer('ddb_id')->nullable();
            $table->string('picture_url')->nullable();
            $table->boolean('is_captain')->default(false);
            $table->foreignId('division_id')->constrained()->nullable();
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
        Schema::dropIfExists('characters');
    }
};
