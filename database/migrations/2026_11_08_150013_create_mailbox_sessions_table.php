<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mailbox_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('mailbox_device_id')->nullable()->constrained()->nullOnDelete();
            $table->string('session_id')->unique();
            $table->ipAddress('ip_address')->nullable();
            $table->timestamp('login_at');
            $table->timestamp('last_activity_at');
            $table->timestamp('revoked_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mailbox_sessions');
    }
};
