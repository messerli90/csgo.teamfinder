<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLookingforPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lookingfor_post', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('lookingfor_id')
				->unsigned();
			$table->integer('post_id')
				->unsigned();

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
		Schema::drop('lookingfor_post');
	}

}
