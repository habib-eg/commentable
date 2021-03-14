<?php

use Habib\Commentable\Models\Commentable;
use Illuminate\Database\Seeder;

class CommentableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        factory(Commentable::class,100)->create();
    }
}
