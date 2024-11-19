<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('project_id'); // Relationship to a project
            $table->unsignedBigInteger('user_id'); // Relationship to a user
            $table->string('status')->default('pending'); // Application status (e.g., "pending", "approved", "rejected")
            $table->string('first_name'); // First name
            $table->string('last_name'); // Last name
            $table->text('skills'); // Skills (store as JSON or text)
            $table->string('availability'); // Availability info
            $table->text('past_experience'); // Past experience
            $table->text('motivation'); // Motivation statement
            $table->string('contact_info'); // Contact info (email or phone)
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
