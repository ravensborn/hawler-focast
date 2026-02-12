<?php

use App\Models\SensorDevice;
use App\Models\SensorParameter;
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
        Schema::create('telemetries', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(SensorDevice::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(SensorParameter::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->double('value')->nullable();

            $table->timestamps();

            $table->index(['sensor_device_id', 'sensor_parameter_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telemetries');
    }
};
