<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSteamuserVoipTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('steamuser_voip', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('steamuser_id')
				->unsigned();
			$table->integer('voip_id')
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
		Schema::drop('steamuser_voip');
	}

}
