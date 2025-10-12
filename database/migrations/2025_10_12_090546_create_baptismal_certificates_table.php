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
        Schema::create('baptismal_certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // user who requested
            $table->date('date');
            $table->string('child_name');
            $table->date('birthdate');
            $table->string('father_name');
            $table->string('mother_name');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baptismal_certificates');
    }
};
