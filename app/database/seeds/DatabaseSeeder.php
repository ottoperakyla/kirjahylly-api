<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		
		$this->call('AuthorsTableSeeder');
		$this->call('LanguagesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('BooksTableSeeder');
		$this->call('ReviewsTableSeeder');
		$this->call('BooksImageSeeder');
	}

}

class BooksImageSeeder extends Seeder {
	

	public function run()
	{
		$books = Book::all();
		$cats = array("abstract","animals","business","cats","city","food","nightlife","fashion","people","nature","sports","technics","transport");
		shuffle($cats);
		$cat = $cats[0];

		for ($i=1, $j=1; $i < count($books); $i++,$j++) { 
			$books[$i]->image = "http://www.lorempixel.com/500/500/$cat/$j";
			$books[$i]->save();

			if ($i % 10 == 0) {
				$cat = array_pop($cats);
				$j=0;
			}
		}	

	}


}

class AuthorsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('authors')->delete();

		$faker = Faker\Factory::create();

		for ($i=0; $i < 5; $i++) { 
			Author::create(array(
				'first' => $faker->firstName(),
				'last' => $faker->lastName()
				));
		}

	}

}

class LanguagesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('books')->delete();

		$faker = Faker\Factory::create();
		$langs = array('fi', 'sv', 'en', 'ru', 'pl');

		for ($i=0; $i < count($langs); $i++) { 
			Language::create(array(
				'language' => $langs[$i]
			));
		}

	}

}

class BooksTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('books')->delete();

		$faker = Faker\Factory::create();

		for ($i=0; $i < 100; $i++) { 
			Book::create(array(
				'title' => $faker->sentence(5),
				'author_id' => getRandomValueFromTableColumn('authors', 'id'),
				'language_id' => getRandomValueFromTableColumn('languages', 'id'),
				'borrower_id' => rand(0, 1) == 0 ? null : getRandomValueFromTableColumn('users', 'id'),
				'year' => rand(1950, 2014),
				'description' => $faker->sentence(10),
				'image' => ''
			));
		}

	}

}

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();

		User::create(array(
			'email' => 'otto.perakyla@fonecta.com',
			'first' => 'Otto',
			'last' => 'Peräkylä',
			'admin' => 1,
			'password' => Hash::make('hasselhoff')
			));

		$faker = Faker\Factory::create();

		for ($i=0; $i < 9; $i++) { 
			User::create(array(
				'email' 	=> $faker->email,
				'first'	 	=> $faker->firstName,
				'last'  	=>  $faker->lastName,
				'admin' 	=> 0,
				'password'  => Hash::make($faker->word)
				));
		}

	}

}

class ReviewsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('reviews')->delete();

		$faker = Faker\Factory::create();

		for ($i=0; $i < 50; $i++) { 
			Review::create(array(
				'body' => $faker->sentence,
				'user_id' => getRandomValueFromTableColumn('users', 'id'),
				'book_id' => getRandomValueFromTableColumn('books', 'id'),
				'stars' => rand(1,5)
				));
		}
	}

}

