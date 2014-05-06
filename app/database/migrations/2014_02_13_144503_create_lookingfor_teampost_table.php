<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLookingforTeampostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lookingfor_teampost', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('lookingfor_id')
				->unsigned();
			$table->integer('teampost_id')
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
		Schema::drop('lookingfor_teampost');
	}

}