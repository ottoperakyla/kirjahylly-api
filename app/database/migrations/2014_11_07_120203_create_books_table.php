<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$table = 'books';

		Schema::dropIfExists($table);

		Schema::create($table, function($t)
		{
			$t->increments('id');
			
			$t->string('title');
			$t->string('description');
			$t->string('image');
			$t->boolean('status')->default(0);
			$t->integer('author_id')->unsigned();
			$t->integer('language_id')->unsigned();
			$t->integer('borrower_id')->unsigned()->nullable();
			$t->integer('year')->unsigned();

			$t->timestamps();
		});

		Schema::table('books', function($table)
		{
			$table->foreign('author_id')->references('id')->on('authors');
			$table->foreign('language_id')->references('id')->on('languages');
			$table->foreign('borrower_id')->references('id')->on('users');
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
