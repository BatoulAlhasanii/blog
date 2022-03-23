<?php

namespace App\Http\Collections;

use Illuminate\Database\Eloquent\Collection;

class CommentCollection extends Collection
{
    public function groupByParent()
    {
        $comments = parent::groupBy('parent_id');

        if (count($comments)) {
            $comments['root'] = $comments[''];
            unset($comments['']);
        }

        return $comments;
    }
}
