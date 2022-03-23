<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Comment;

class CommentTest extends TestCase
{
    protected string $endpoint = '/api/comments';
    protected string $table_name = 'comments';

    public function test_get_all_comments()
    {
        $comments_level_1 = Comment::factory(3)->create();
        
        $comments_level_2 = Comment::factory(3)->create([
            'parent_id' => $comments_level_1[0]->id
        ]);

        $comments_level_3 = Comment::factory(2)->create([
            'parent_id' => $comments_level_2[2]->id
        ]);

        $this->json('GET', $this->endpoint)
            ->assertStatus(200)
            ->assertSee($comments_level_1[0]['content'])
            ->assertSee($comments_level_2[0]['content'])
            ->assertSee($comments_level_3[0]['content']);

        $this->assertDatabaseHas($this->table_name, [
            'id' => $comments_level_1[0]['id'],
            'content' => $comments_level_1[0]['content']
        ]);
    }

    public function test_create_comment()
    {
        $comment = Comment::factory()->make()->toArray();

        $this->json('POST', $this->endpoint, $comment)
            ->assertStatus(201);

        $this->assertDatabaseHas($this->table_name, [
            'id' => 1,
            'content' => $comment['content']
        ]);
    }
}
