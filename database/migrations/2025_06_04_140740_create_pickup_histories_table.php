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
        Schema::create('pickup_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_id')->constrained('guardians')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('qr_token')->nullable();
            $table->enum('type', ['drop', 'pickup'])->default('pickup')->nullable();
            $table->date('date')->nullable();      // waktu mulai scan
            $table->timestamp('start_at')->nullable();      // waktu mulai scan
            $table->timestamp('end_at')->nullable(); // waktu selesai pickup
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_histories');
    }
};
