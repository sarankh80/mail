<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mailbox_aliases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mailbox_account_id')->constrained()->cascadeOnDelete();
            $table->string('alias_email')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mailbox_aliases');
    }
};
