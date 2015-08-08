<?php

class CategorySeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		Category::create(array('category_name' => 'Random stuff'));
		Category::create(array('category_name' => 'Personal stuff'));
		Category::create(array('category_name' => 'Programming stuff'));
		Category::create(array('category_name' => 'Technical stuff'));
		Category::create(array('category_name' => 'Funny stuff'));
	}

}
