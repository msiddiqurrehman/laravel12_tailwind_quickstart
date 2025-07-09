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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 128)->index();
            $table->tinyInteger('status')->default(1)->index()->comment('0 -> Inactive, 1 -> Active');
            $table->foreignId('country_id')->comment('foreign key to countries.id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->comment('foreign key to users.id')->constrained('users')->onUpdate('cascade')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('state_id')->nullable()->after('district')
                ->comment('Foreign key to states.id')
                ->constrained()->onUpdate('cascade')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
