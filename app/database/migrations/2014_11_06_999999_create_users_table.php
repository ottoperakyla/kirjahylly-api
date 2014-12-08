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
		$table = 'users';

		Schema::dropIfExists($table);

		Schema::create($table, function($t)
		{
			$t->increments('id');
			
			$t->string('email');
			$t->string('first');
			$t->string('last');
			$t->boolean('admin')->default(0);
			$t->string('password');
			$t->rememberToken();

			$t->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
