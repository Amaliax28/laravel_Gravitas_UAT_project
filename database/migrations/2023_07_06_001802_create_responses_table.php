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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('test_cases_id')->constrained()->onDelete('cascade');
            $table->longText('responseText')->nullable();
            $table->string("desktop");
            $table->string("mobile");
            $table->string("status");
            $table->string('feedbackFile')->nullable();
            $table->string('feedbackImg')->nullable();
            $table->string('priorities')->nullable();
            $table->string('responseTime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
