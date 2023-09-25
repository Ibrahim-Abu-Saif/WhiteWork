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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->text('content');
            $table->double('price', 10, 3);
            $table->string('duration');
            $table->boolean('status')->default(1);
            $table->foreignId('category_id')->nullable()->constrained('categories', 'id')->nullOnDelete();
            $table->foreignId('company_id')->constrained('companies', 'id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
