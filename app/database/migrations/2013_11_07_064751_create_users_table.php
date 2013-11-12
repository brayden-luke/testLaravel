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
			$table->timestamps();
			$table->text('username');
			$table->text('email');
			$table->text('password');
		});

		Schema::create('activations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('userid');
			$table->foreign('userid')->references('id')->on('users');
			$table->activation_key('email');
			$table->activation_status('password');
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
