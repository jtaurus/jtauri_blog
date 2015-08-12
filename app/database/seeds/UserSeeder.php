<?php

class UserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		User::create(array('username' => 'Jakub',
				'email' => 'jakub@jakub.com',
				'password' => Hash::make('123'),
				'admin' => true));
		User::create(array('username' => 'random_user',
				'email' => 'random_user@random_user.com',
				'password' => Hash::make('123'),
				'admin' => false));
		User::create(array('username' => 'someone88',
				'email' => 'someone88@someone88.com',
				'password' => Hash::make('123'),
				'admin' => false));
	}

}
