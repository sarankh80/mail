<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mailbox_quotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mailbox_account_id')->unique()->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quota_mb');
            $table->unsignedInteger('used_mb')->default(0);
            $table->unsignedInteger('inbox_mb')->default(0);
            $table->unsignedInteger('sent_mb')->default(0);
            $table->unsignedInteger('trash_mb')->default(0);
            $table->unsignedInteger('attachments_mb')->default(0);
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mailbox_quotas');
    }
};
