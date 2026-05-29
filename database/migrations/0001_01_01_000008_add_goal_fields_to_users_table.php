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
        Schema::table('users', function (Blueprint $table) {
            $table->float('goal_weight')->nullable()->after('role');
            $table->integer('goal_water')->nullable()->after('goal_weight');
            $table->integer('goal_steps')->nullable()->after('goal_water');
            $table->float('goal_sleep')->nullable()->after('goal_steps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['goal_weight', 'goal_water', 'goal_steps', 'goal_sleep']);
        });
    }
};
