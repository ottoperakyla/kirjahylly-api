<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviews', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('book_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('body');
			$table->integer('stars')->unsigned();

			$table->timestamps();
		});

		Schema::table('reviews', function($table)
		{
				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('book_id')->references('id')->on('books');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reviews');
	}

}
