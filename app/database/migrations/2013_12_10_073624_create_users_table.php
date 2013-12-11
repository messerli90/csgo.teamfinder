<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('username', 30)
				->unique();

			$table->string('password', 60);

			$table->string('email')
				->unique();

			$table->string('steam')
				->nullable();

			$table->string('esea')
				->nullable();

			$table->string('leetway')
				->nullable();

			$table->string('altpug')
				->nullable();

			$table->integer('region_id')
				->nullable()
				->unsigned();

			$table->integer('skill_id')
				->nullable()
				->unsigned();

			$table->integer('rank_id')
				->nullable()
				->unsigned();

			$table->text('bio')
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
		Schema::drop('users');
	}

}
