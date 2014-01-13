<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSteamuserToRatingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ratings', function(Blueprint $table)
		{
			$table->bigInteger('steamuser_id')
				->nullable();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ratings', function(Blueprint $table)
		{
			$table->dropColumn('steamuser_id');
		});
	}

}