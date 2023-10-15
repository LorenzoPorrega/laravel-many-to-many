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
			// I create a "user_id" column in "projects" table
			// nullable() is TRIVIAL because in the current situation projects and users are not already linked,
			//if it wasn't nullable it could create issues between unlinked previous projects and users
			// This has to be a rule for any new migration that relates tables that weren't related before
			$table->unsignedBigInteger('user_id')->nullable();

			// I say that "user_id" column is the foreign key linking to "id" column in "users" table
			$table->foreign('user_id')
						->references('id')
						->on('users')
						// If a user gets deleted I also delete theirs linked projects (this is optional but could save storage space on DB)
						->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('projects', function (Blueprint $table) {
			// I drop the foreign key RELATION between "projects" and "users" table (the relation can be seen in the INDEXES section on phpMyAdmin)
			$table->dropForeign('projects_user_id_foreign');
			// I drop the column itself in the "projects" table
			$table->dropColumn('user_id');
		});
	}
};
