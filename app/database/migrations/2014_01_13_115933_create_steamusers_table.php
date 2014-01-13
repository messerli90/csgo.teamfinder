<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSteamusersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('steamusers', function(Blueprint $table)
		{
			$table->bigInteger('id');

			$table->string('username', 50)
				->unique();

			$table->string('avatar')
				->nullable();

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
		Schema::drop('steamusers');
	}

}