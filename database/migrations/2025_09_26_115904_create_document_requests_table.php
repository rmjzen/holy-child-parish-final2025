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
        Schema::create('document_requests', function (Blueprint $table) {
            $table->id();
            $table->string('document_type');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->date('marriage_date')->nullable();
            $table->string('marriage_place')->nullable();
            $table->string('location')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('child_name')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_requests');
    }
};
