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
        Schema::create('sacramental_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // add this line
            $table->enum('service_type', ['Wedding', 'Baptism', 'Funeral', 'Mass'])->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('location')->nullable();
            $table->string('full_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Cancelled', 'Completed'])->default('Pending'); // ✅ added

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {`
        Schema::dropIfExists('sacramental_services');
    }
};
