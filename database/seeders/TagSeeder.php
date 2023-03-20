<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['PHP','Laravel','Back End Development','Front End Development','Full Stack Development','Cricket','Football','Hollywood','Bollywood'];

        foreach($categories as $category)
        Tag::create([
            'name' => $category
        ]);
    }
}
