<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaystyleTeampostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('playstyle_teampost', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('playstyle_id')
				->unsigned()
				->index();
			$table->integer('teampost_id')
				->unsigned()
				->inded();
				
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
		Schema::drop('playstyle_teampost');
	}

}