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
        Schema::create('flower', function (Blueprint $table) {
            $table->id();
            $table->string('flower_name');
            $table->string('picture');
            $table->string('character');
            $table->string('meaning');
            $table->string('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flower');
    }
};
