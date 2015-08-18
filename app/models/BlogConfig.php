<?php

class BlogConfig extends Eloquent{

	protected $table = "blog_configs";

	public static function getConfigValue($key){
		return self::find($key)->value;
	}

}