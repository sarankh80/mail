<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->after('id');
            $table->string('status')->default('active')->after('password');
            $table->boolean('is_owner')->default(false)->after('status');
            $table->timestamp('suspended_at')->nullable()->after('is_owner');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['uuid', 'status', 'is_owner', 'suspended_at']);
        });
    }
};
