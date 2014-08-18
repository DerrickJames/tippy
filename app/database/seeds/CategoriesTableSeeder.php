<?php

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		$categories = [
			[
                'id'          => '1',
                'name'        => 'Business',
                'slug'        => 'business',
                'description' => 'All tips related to the business category, e.g shops, malls.',
                'order'       => '1',
            ],
            [
                'id'          => '2',
                'name'        => 'Entertainment',
                'slug'        => 'entertainment',
                'description' => 'All tips related to the entertainment category, e.g musicians',
                'order'       => '2',
            ],
		];

		DB::table('categories')->insert($categories);
	}

}