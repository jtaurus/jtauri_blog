<?php

class Comment extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	 
	public function user(){
		return $this->belongsTo('User')->select(array('id', 'username'));
	}
	
	public function post(){
		return $this->belongsTo('Post');
	}
}
