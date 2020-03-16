<?php

use Illuminate\Database\Seeder;
use App\CheckInCategory;

class CheckInCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'イベント',
            '勉強',
            '仕事',
            'その他',
        ];

        foreach ($categories as $category) {
            CheckInCategory::create(['name' => $category]);
        }
    }
}
