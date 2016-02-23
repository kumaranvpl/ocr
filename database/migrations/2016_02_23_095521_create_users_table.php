<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 25);
			$table->string('email', 60)->unique('email');
			$table->string('password', 300);
			$table->string('employee_id', 30)->unique('employee_id');
			$table->string('company', 30);
			$table->string('is_admin', 25)->default('no');
			$table->bigInteger('added_by');
			$table->string('is_confirmed', 20)->default('no');
			$table->timestamp('time_created')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('time_verified');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
