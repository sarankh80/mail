<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_quarantine', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('mailbox_account_id')->constrained()->cascadeOnDelete();
            $table->string('sender');
            $table->string('recipient');
            $table->string('subject')->nullable();
            $table->timestamp('received_at');
            $table->string('detection_reason')->nullable();
            $table->decimal('risk_score', 5, 2)->nullable();
            $table->string('storage_path');
            $table->date('retention_until');
            $table->string('status')->default('held'); // held|released|deleted|blocked_sender
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_quarantine');
    }
};
