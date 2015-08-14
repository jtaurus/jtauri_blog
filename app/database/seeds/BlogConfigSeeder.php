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

		BlogConfig::create(array('name' => 'test', 'value' => 'value_of_test'));

}
}
