<?php

class Author extends Base {

	protected $guarded = array('id');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'authors';

	public function books()
	{
		return $this->hasMany("Book");
	}

}
