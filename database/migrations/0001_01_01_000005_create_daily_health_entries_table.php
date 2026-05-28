<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_health_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->float('sleep_hours')->default(0);
            $table->integer('water_glasses')->default(0);
            $table->integer('steps')->default(0);
            $table->integer('calories')->default(0);
            $table->string('mood')->nullable();
            $table->string('note')->nullable();
            $table->integer('points_earned')->default(0);
            $table->timestamps();

            $table->unique(['user_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_health_entries');
    }
};
