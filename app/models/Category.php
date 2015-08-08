<?php

class Category extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	
	public function post(){
		return $this->hasMany('Post');
	}
}
