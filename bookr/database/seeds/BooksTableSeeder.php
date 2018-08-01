<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Author::class, 10)->create()->each(function ($author) {
            $booksCount = rand(1, 5);

            while ($booksCount > 0) {
                $author->books()->save(factory(App\Book::class)->make());
                $booksCount--;
            }
        });
    }
}
