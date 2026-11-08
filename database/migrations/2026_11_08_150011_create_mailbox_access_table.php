<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mailbox_access', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mailbox_account_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('permission'); // read|send|send_as
            $table->foreignId('granted_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['mailbox_account_id', 'user_id', 'permission']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mailbox_access');
    }
};
