<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCategoriesFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categories_fields', function(Blueprint $table)
		{
			$table->foreign('fields_id', 'categories_fields_field_id_foreign')->references('id')->on('fields')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('categories_id', 'categories_fields_category_id_foreign')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categories_fields', function(Blueprint $table)
		{
			$table->dropForeign('categories_fields_field_id_foreign');
			$table->dropForeign('categories_fields_category_id_foreign');
		});
	}

}
