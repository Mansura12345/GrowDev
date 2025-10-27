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
        Schema::create('srs_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('project_overview')->nullable();
            $table->text('scope')->nullable();
            $table->text('constraints')->nullable();
            $table->text('assumptions')->nullable();
            $table->timestamps();
        });

        Schema::create('srs_functional_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('srs_document_id')->constrained('srs_documents')->cascadeOnDelete();
            $table->string('requirement_id')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('priority')->default('medium'); // low, medium, high, critical
            $table->json('ux_considerations')->nullable(); // Store UX items as JSON array
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('srs_functional_requirements');
        Schema::dropIfExists('srs_documents');
    }
};
