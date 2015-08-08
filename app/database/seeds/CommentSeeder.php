<?php

class CommentSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		Comment::create(array('user_id' => 1,
			'post_id' => 1,
			'body_comment' => 'This is the body for a comment'));

		Comment::create(array('user_id' => 2,
			'post_id' => 3,
			'body_comment' => 'This is the body for a comment'));

		Comment::create(array('user_id' => 3,
			'post_id' => 3,
			'body_comment' => 'This is the body for a comment'));

	}
}