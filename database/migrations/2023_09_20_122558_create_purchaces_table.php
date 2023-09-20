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
        Schema::create('purchaces', function (Blueprint $table) {
            $table->id();

            // relationship to user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // stripe purchade details
            $table->string('stripe_id');
            $table->string('stripe_status');
            $table->string('stripe_product_id');
            $table->string('stripe_price_id');
            $table->string('stripe_last_digits');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchaces');
    }
};
