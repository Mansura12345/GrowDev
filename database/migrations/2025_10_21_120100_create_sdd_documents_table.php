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
        Schema::create('sdd_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('design_overview')->nullable();
            $table->text('architecture_overview')->nullable();
            $table->timestamps();
        });

        Schema::create('sdd_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sdd_document_id')->constrained('sdd_documents')->cascadeOnDelete();
            $table->string('component_name');
            $table->text('description');
            $table->text('responsibility');
            $table->text('interfaces')->nullable();
            $table->json('diagram_data')->nullable(); // Store mermaid diagram or drag-drop diagram data
            $table->string('diagram_type')->default('mermaid'); // mermaid or custom
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('sdd_diagrams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sdd_document_id')->constrained('sdd_documents')->cascadeOnDelete();
            $table->string('diagram_name');
            $table->string('diagram_type'); // class, sequence, flowchart, state, etc.
            $table->text('diagram_content'); // Mermaid syntax or custom JSON
            $table->text('text_description')->nullable(); // Text that was converted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sdd_diagrams');
        Schema::dropIfExists('sdd_components');
        Schema::dropIfExists('sdd_documents');
    }
};
