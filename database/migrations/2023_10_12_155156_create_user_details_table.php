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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();

            $table->string("phone_number")->nullable();
            $table->string("adress")->nullable();
            $table->string("birth_date")->nullable();
            $table->string("identity_card_code")->nullable();
            // here we don't need nullable() because the user_details table will be created, not updated with an inserted column
            $table->unsignedBigInteger("user_id");

            $table->timestamps();

            $table->foreign("user_id")
                  ->references("id")
                  ->on("users")
                  ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
