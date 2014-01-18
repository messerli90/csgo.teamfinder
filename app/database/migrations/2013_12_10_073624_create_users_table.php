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
			$table->bigInteger('id')
				->unique();

			$table->string('username');

			$table->string('avatar');

			$table->string('email')
				->nullable();

			$table->date('birthday')
				->nullable();

			$table->string('steam')
				->nullable();

			$table->string('esea')
				->nullable();

			$table->string('leetway')
				->nullable();

			$table->string('altpug')
				->nullable();

			$table->integer('rating')
				->default(0);

			$table->integer('region_id')
				->nullable()
				->unsigned();

			$table->integer('skill_id')
				->nullable()
				->unsigned();

			$table->integer('rank_id')
				->default(19)
				->unsigned();

			$table->integer('status_id')
				->default(1)
				->unsigned();

			$table->text('bio')
				->nullable();

			$table->text('experience')
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
