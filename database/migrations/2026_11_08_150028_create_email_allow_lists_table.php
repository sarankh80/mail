<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_allow_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mailbox_account_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('type'); // email|domain
            $table->string('value');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_allow_lists');
    }
};
