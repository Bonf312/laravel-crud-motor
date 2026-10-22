<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spesifikasi_motors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('motor_id')
                ->unique()
                ->constrained('motors')
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('kapasitas_cc')->nullable();
            $table->string('transmisi', 50)->nullable();
            $table->string('bahan_bakar', 50)->nullable();
            $table->decimal('berat_motor', 7, 2)->nullable();
            $table->decimal('kapasitas_tangki', 7, 2)->nullable();
            $table->boolean('rem_abs')->default(false);
            $table->string('sistem_pendingin', 100)->nullable();
            $table->decimal('tenaga_mesin', 8, 2)->nullable();
            $table->decimal('torsi', 8, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spesifikasi_motors');
    }
};