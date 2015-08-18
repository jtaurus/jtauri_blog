<?php

class BlogConfig extends Eloquent{

	protected $table = "blog_configs";

	protected $primaryKey = 'name';

	public static function getConfigValue($key){
		return self::find($key)->value;
	}

}