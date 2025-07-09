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
        Schema::create('emp_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('foreign key to users.id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('designation_id')->nullable()->comment('Foreign key to designations.id')->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->string('referrer_name', length: 128)->nullable()->index();
            $table->string('referrer_contact', length: 16)->nullable()->index();
            $table->string('identity_document_path', length: 512)->nullable();
            $table->string('education_document_path', length: 512)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_details');
    }
};
