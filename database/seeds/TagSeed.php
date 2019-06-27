<?php

use Illuminate\Database\Seeder;

class TagSeed extends Seeder
{

    public function run()
    {
       factory(App\Tag::class,30)->create();
    }
}
