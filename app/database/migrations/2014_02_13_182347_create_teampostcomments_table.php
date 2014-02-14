<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeampostcommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teampostcomments', function(Blueprint $table)
		{
			$table->increments('id');

			$table->bigInteger('teampost_id');
			$table->bigInteger('author_id');
			$table->text('comment');

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
		Schema::drop('teampostcomments');
	}

}