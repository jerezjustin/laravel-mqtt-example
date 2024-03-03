<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('device_user', function (Blueprint $table) {
            $table->foreignId('device_id');
            $table->foreignId('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('device_user');
    }
};
