<?php

class Review extends Base {

	protected $guarded = array('id');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reviews';

	public function book()
	{
		return $this->belongsTo('Book');
	}

}
