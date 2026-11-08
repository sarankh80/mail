<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mailbox_request_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mailbox_request_id')->constrained()->cascadeOnDelete();
            $table->string('token_hash');
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mailbox_request_verifications');
    }
};
