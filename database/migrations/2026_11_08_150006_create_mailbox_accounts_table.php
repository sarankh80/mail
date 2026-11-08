<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mailbox_accounts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('email')->unique();
            $table->string('linux_username')->unique();
            $table->string('type')->default('personal'); // personal|shared
            $table->string('status')->default('pending'); // pending|active|suspended|deleted
            $table->unsignedInteger('quota_mb')->default(1024);
            $table->timestamp('suspended_at')->nullable();
            $table->timestamp('provisioned_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mailbox_accounts');
    }
};
