<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag = new  \App\Models\Tag();
        $tag->nom = "#homme";
        $tag->save();

        $tag2 = new  \App\Models\Tag();
        $tag2->nom = "#femme";
        $tag2->save();
    }
}
