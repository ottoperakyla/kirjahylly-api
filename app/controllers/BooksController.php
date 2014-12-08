<?php

class BooksController extends \BaseController {

	public function __construct() {
		$this->beforeFilter('auth');
		$this->rules = array(
			'title'    => 'required|unique:books',
			'author_id'   => 'required',
			'language_id' => 'required',
			'year'     => 'required|integer',
			'image'    => 'image'
			);
	}

	public function borrow($book_id)
	{
		$book = Book::find($book_id);
		$book->borrower_id = $book->borrower_id != null ? null : Auth::user()->id;
		$book->save();

		return Redirect::to('books');
	}

	public function borrowAs($book_id, $user_id) 
	{
		$book = Book::find($book_id);
		$book->borrower_id = $user_id;
		$book->save();
		return $book;
	}

	public function returnBook($book_id) 
	{
		$book = Book::find($book_id);
		$book->borrower_id = null;
		$book->save();
		return $book;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$borrowedText = array(
			0 => array('Borrow', 'btn-success'),
			1 => array('Return', 'btn-primary')
		);

		$languages = Language::all();

		$books = Book::with('author')->paginate(Config::get('constants.PAGINATION_ITEMS_PER_PAGE'));

		foreach ($books as $book) {
			$book->status = $book->borrower_id != 0 ? 1 : 0;
		}

		return View::make('books/index')
					->with('books', $books)
					->with('languages', $languages)
					->with('borrowedText', $borrowedText);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('books/create')
		->with('book', new Book)
		->with('authors', Author::getSelectFields(array('first', 'last')))
		->with('languages', Language::getSelectFields(array('language')));
	}

	/**
	* Store image in image folder
	*
	* @return Path to image
	*/
	private function storeImage($img)
	{
		$imageName = $img->getClientOriginalName();
		$imgPath = public_path() . "\\img\\";
		$img->move($imgPath, $imageName);
		return URL::to('/assets/img') . "/" . $imageName;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$v = Validator::make(Input::all(), $this->rules);

		if ($v->passes()) {
			$book = new Book(Input::all());
			$book->image = $book->image ? $this->storeImage(Input::all('image')) : "";
			$book->save();
			return Redirect::to('/books');
		} 	

		return Redirect::action('BooksController@create')
		->withErrors($v);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Response::json(Book::find($id));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('books/edit')
		->with('book', Book::find($id))
		->with('authors', Author::getSelectFields(array('first', 'last')))
		->with('languages', Language::getSelectFields(array('language')));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$book = Book::find($id);

		$book->update(Input::all());

		if (Input::has('status')) {
			$book->status = true;
		} else {
			$book->status = false;
		}

		$book->save();

		Session::flash('active', $book->id);

		return Redirect::route('books.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Book::where('id', $id)->delete();

		return Redirect::route('books.index');
	}


}
