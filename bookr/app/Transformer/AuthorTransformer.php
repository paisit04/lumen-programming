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
            'rating' => [
                'average' => (float) sprintf(
                    "%.2f",
                    $author->ratings->avg('value')
                ),
                'max' => (float) sprintf("%.2f", 5),
                'percent' => (float) sprintf(
                    "%.2f",
                    ($author->ratings->avg('value') / 5) * 100
                ),
                'count' => $author->ratings->count(),
            ],
            'created' => $author->created_at->toIso8601String(),
            'updated' => $author->updated_at->toIso8601String(),
        ];
    }

    public function includeBooks(Author $author)
    {
        return $this->collection($author->books, new BookTransformer());
    }
}
