<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Laptop', 'PC', 'Phone', 'Hard'];
        $db_cats = [];
        foreach ($categories as $cat) {
            $db_cats[] = [
                'name' => $cat
            ];
        }

        Category::insert($db_cats);
    }
}
