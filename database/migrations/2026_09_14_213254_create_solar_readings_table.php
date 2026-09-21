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
        Schema::create('solar_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solar_system_id')->constrained()->cascadeOnDelete();
            $table->dateTime('reading_time');
            $table->decimal('energy_produced_kwh', 10, 2);
            $table->decimal('current_power_w', 10, 2)->nullable();
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solar_readings');
    }
};
