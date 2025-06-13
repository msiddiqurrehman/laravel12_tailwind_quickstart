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
        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->string('title', length: 64)->index();
            $table->foreignId('created_by')->nullable()->comment('foreign key to users.id')->constrained('users')->onUpdate('cascade')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('designation_id')->nullable()->after('user_type_id')
                                        ->comment('Foreign key to designations.id')
                                        ->constrained()->onUpdate('cascade')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designations');
    }
};
