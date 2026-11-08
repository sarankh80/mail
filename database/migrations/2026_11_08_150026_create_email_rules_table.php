<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mailbox_account_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->json('conditions')->nullable();
            $table->json('actions')->nullable();
            $table->unsignedInteger('priority')->default(0);
            $table->boolean('enabled')->default(true);
            $table->boolean('is_vacation_responder')->default(false);
            $table->string('vacation_subject')->nullable();
            $table->text('vacation_body')->nullable();
            $table->date('vacation_start_date')->nullable();
            $table->date('vacation_end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_rules');
    }
};
