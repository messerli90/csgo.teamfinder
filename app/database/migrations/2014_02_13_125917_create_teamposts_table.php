<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeampostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teamposts', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name')
				->index();
			$table->string('avatar')
				->default('/img/teamposts/default.png');
			$table->bigInteger('user_id')
				->unsigned();
			$table->integer('region_id')
				->unsigned();
			$table->string('language')
				->default('English');
			$table->integer('skill_id')
				->nullable()
				->unsigned();
			$table->string('website')
				->nullable();
			$table->string('steamgroup')
				->nullable();
			$table->string('league')
				->default('none');
			$table->text('info')
				->nullable();

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
		Schema::drop('teamposts');
	}

}