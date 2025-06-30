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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->comment('foreign key to roles.id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('module_id')->comment('foreign key to modules.id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('can_create')->index();
            $table->boolean('can_delete')->index();
            $table->boolean('can_edit')->index();
            $table->boolean('can_view')->index();
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
        Schema::dropIfExists('permissions');
    }
};
