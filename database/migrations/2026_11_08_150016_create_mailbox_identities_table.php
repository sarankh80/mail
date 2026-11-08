<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mailbox_identities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mailbox_account_id')->constrained()->cascadeOnDelete();
            $table->string('display_name');
            $table->string('reply_to')->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mailbox_identities');
    }
};
