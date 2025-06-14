<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->comment('foreign key to roles.id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->comment('foreign key to users.id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->comment('foreign key to users.id')->constrained('users')->onUpdate('cascade')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
