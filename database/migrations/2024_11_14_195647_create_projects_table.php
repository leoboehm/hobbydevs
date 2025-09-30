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
            $table->unsignedBigInteger('owner_id');
            $table->string('title');
            $table->longText('description');
            $table->string('category');
            $table->text('skills');
            $table->string('salary_range')->nullable();
            $table->string('duration')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->timestamp('application_start_date')->nullable();
            $table->timestamp('application_deadline')->nullable();
            $table->timestamps();
            
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
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
