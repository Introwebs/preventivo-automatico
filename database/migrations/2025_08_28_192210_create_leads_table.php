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
        Schema::disableForeignKeyConstraints();

        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->constrained('lead_statuses')->onDelete('set null');
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('phone', 20)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
