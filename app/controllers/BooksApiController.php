<?php

class BooksApiController extends \BaseController {

	public function borrow($id)
	{
		$book = Book::find($id);
		$book->status = $book->status ? 0 : 1;
		$book->save();
		return $book;
	}

	/**
	* Return all books as JSON
	*
	* @return Response
	*/
	public function index() 
	{
		return Response::json(Book::allWithReviewsAverage());
	}

	public function show($id)
	{
		return Response::json(Book::withReviewsAverage($id));
	}

}
