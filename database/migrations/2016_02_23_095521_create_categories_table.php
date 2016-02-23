<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('category_name', 30);
			$table->string('fields_needed', 300);
			$table->string('tags', 300);
			$table->integer('added_by');
			$table->string('is_enabled', 30)->default('no');
			$table->timestamp('time_created')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('bill_types', 100);
			$table->string('program_api', 300);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
