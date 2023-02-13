<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  $tags = collect(['Topology', 'Number Theory', 'Probability', 'Statistics', 'Calculus', 'Trigonometry', 'Geometry','Algebra','Arithmetic','Foundations']);

        $tags->each(function($tag){
            $myTag = new Tag();
            $myTag->name = $tag;
            $myTag->save();
        });
    }
}
