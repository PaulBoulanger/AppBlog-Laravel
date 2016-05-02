<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Tag::create([
            'name' => 'Tag 1'
        ]);

        \App\Tag::create([
            'name' => 'Tag 2'
        ]);

        \App\Tag::create([
            'name' => 'Tag 3'
        ]);
    }
}
