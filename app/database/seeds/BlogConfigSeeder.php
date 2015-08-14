<?php

class BlogConfigSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		BlogConfig::create(array('name' => 'title', 'value' => 'Jtauri blog'));
		BlogConfig::create(array('name' => 'user_posting_enabled', 'value' => 'true'));
		BlogConfig::create(array('name' => 'user_can_edit_posts', 'value' => 'true'));
		BlogConfig::create(array('name' => 'post_moderation', 'value' => 'true'));
		BlogConfig::create(array('name' => 'registration_enabled', 'value' => 'true'));
}
}
