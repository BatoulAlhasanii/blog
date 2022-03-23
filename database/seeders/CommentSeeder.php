<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments_level_1 = Comment::factory(3)->create();
        
        $comments_level_2 = Comment::factory(3)->create([
            'parent_id' => $comments_level_1[0]->id
        ]);

        Comment::factory(2)->create([
            'parent_id' => $comments_level_2[2]->id
        ]);
    }
}
