<?php

class Book extends Base {

	protected $guarded = array();

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'books';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function author()
	{
		return $this->belongsTo('Author');
	}

	public function language()
	{
		return $this->belongsTo('Language');
	}

	public function reviews()
	{
		return $this->hasMany('Review');
	}

	public static function allWithReviewsAverage()
	{ 
		$books = Book::with('author')->get();

		foreach ($books as $book) {
			$book->reviewsAverage = self::getReviewsAverage($book);
		}

		return $books;
	}

	public static function withReviewsAverage($id)
	{
		$book = Book::with('author')->find($id);
		$book->reviewsAverage = self::getReviewsAverage($book);
		return $book;
	}

	private static function getReviewsAverage($book)
	{
		$total = 0;

		foreach ($book->reviews as $review) {
			$total += $review->stars;
		}

		return count($book->reviews) != 0 ? $total / count($book->reviews) : 0;
	}

}
