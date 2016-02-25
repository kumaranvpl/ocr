<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories_fields', function(Blueprint $table)
		{
			$table->integer('categories_id')->index('categories_fields_category_id_foreign');
			$table->integer('fields_id')->unsigned()->index('categories_fields_field_id_foreign');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories_fields');
	}

}
