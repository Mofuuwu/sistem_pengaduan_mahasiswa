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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->enum('name', ['dikirim', 'diterima', 'ditinjau', 'diproses', 'selesai', 'ditolak', 'dibatalkan', 'ditangguhkan']);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('complaint_id');
            $table->text('path_file')->nullable();
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
