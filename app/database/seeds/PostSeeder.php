<?php

class PostSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		Post::create(array('user_id' => 1,
			'category_id' => 1,
			'title' => 'This is a title',
			'body' => 'This is a body',
			'moderated' => true));
		Post::create(array('user_id' => 2,
			'category_id' => 2,
			'title' => 'This is the second title',
			'body' => 'This is the second body',
			'moderated' => true));
		Post::create(array('user_id' => 3,
			'category_id' => 3,
			'title' => 'This is the third title',
			'body' => 'This is the third body',
			'moderated' => true));
		Post::create(array('user_id' => 3,
			'category_id' => 2,
			'title' => 'This is the fourth title',
			'body' => 'This article should no be visible by default because its moderated field is set to false',
			'moderated' => false));
	}

}
