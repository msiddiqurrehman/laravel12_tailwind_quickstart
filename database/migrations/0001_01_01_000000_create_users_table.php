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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', length: 128)->index();
            $table->string('last_name', length: 128)->nullable()->index();
            $table->string('email')->unique()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('gender', ['female', 'male']);
            $table->string('contact_no', length: 16)->nullable()->index();
            $table->string('sec_contact_no', length: 16)->nullable()->index();
            $table->string('image_path', length: 512)->nullable();
            $table->string('password');
            $table->string('address', length: 256)->nullable();
            $table->string('city', length: 64)->nullable()->index();
            $table->string('district', length: 64)->nullable()->index();
            $table->rememberToken();
            $table->tinyInteger('status')->default(1)->index()->comment('0 -> Inactive, 1 -> Active');
            $table->foreignId('created_by')->nullable()->comment('foreign key to users.id')->constrained('users')->onUpdate('cascade')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
