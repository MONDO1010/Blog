<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $category = new \App\Models\Category();
        $category->nom = "sans_embryllage";
        $category->is_online = 1;
        $category->save();

        $category2 = new \App\Models\Category();
        $category2->nom = "a_embryllage";
        $category2->is_online = 1;
        $category2->save();

        $category3 = new \App\Models\Category();
        $category3->nom = "trycicle_guidon";
        $category3->is_online = 1;
        $category3->save();

        $category4 = new \App\Models\Category();
        $category4->nom = "trycicle_volan";
        $category4->is_online = 1;
        $category4->save();
    }
}
