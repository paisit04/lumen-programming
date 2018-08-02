<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;

use App\Author;

class AuthorTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['books'];

    public function transform(Author $author)
    {
        return [
            'id' => $author->id,
            'name' => $author->name,
            'gender' => $author->gender,
            'biography' => $author->biography,
            'created' => $author->created_at->toIso8601String(),
            'updated' => $author->updated_at->toIso8601String(),
        ];
    }

    public function includeBooks(Author $author)
    {
        return $this->collection($author->books, new BookTransformer());
    }
}
