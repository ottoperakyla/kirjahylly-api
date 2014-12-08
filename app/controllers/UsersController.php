<?php

class UsersController extends \BaseController {

	/**
	 * Show form for logging in user.
	 *
	 * @return Response
	 */
	public function showLogin() 
	{
		return Auth::check() ? Redirect::to('books') : View::make('login/index');
	}

	/**
	 * Attempt to login user.
	 *
	 * @return Response
	 */
	public function attemptLogin() 
	{
		if (Auth::attempt(array('email' => Input::get('username'), 'password' => Input::get('password')))) 
		{
			return Redirect::to('/books');
		}
	}

	/**
	 * Attempt to login user remotely.
	 *
	 * @return Response
	 */
	public function attemptLoginApi() 
	{
		Auth::attempt(array('email' => Input::get('username'), 'password' => Input::get('password')));
	}

	public function doLogout() 
	{
		Auth::logout();
		return Redirect::to('/');
	}

	public function resetPassword($id)
	{
		$user = User::find($id);

		Mail::send('emails.auth.reminder', array('token' => time() . " " . $user->id), function($message) use ($user)
		{	
			$message->to($user->email, $user->first)->subject('Password reset');
		});	

		return Redirect::to('/');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('users/index')
		->with('users', User::paginate(Config::get('constants.PAGINATION_ITEMS_PER_PAGE')));
	}

	public function apiLogin()
	{
		$auth = array(
			'email' => Input::get('username'),
			'password' => Input::get('password'),
		);

		if (Auth::attempt($auth)) {
			return Auth::user();
		}

		return -1;
	}

	public function apiLogout()
	{
		Auth::logout();
		return true;
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('users.edit')
		->with('user', User::find($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
