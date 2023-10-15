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
        Schema::table('projects', function (Blueprint $table) {
            // In this case we need the category_id to be null given that we're adding a column into an already existing table, "projects"
            $table->unsignedBigInteger("category_id")->nullable();

            $table->foreign("category_id")
                  ->references("id")
                  ->on("categories")
                  // This time we use "set null" instead of "cascade" so that if we delete a category we don't automatically delete a whole 
                  // set of projects related to that category
                  ->onDelete("set null");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign("projects_category_id_foreign");
            $table->dropColumn("category_id");
        });
    }
};
