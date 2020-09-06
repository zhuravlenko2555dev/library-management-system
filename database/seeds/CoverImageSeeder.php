<?php

use Illuminate\Database\Seeder;

class CoverImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_books = DB::table('books')->whereNotNull('image_small')->get()->toBase()->toArray();
        $books_covers_path = 'D:\books_covers';

        foreach ($all_books as $index => $book) {
            if (file_exists($books_covers_path . DIRECTORY_SEPARATOR . 's' . DIRECTORY_SEPARATOR . explode('/', $book->image_small)[2])) {
                File::move($books_covers_path . DIRECTORY_SEPARATOR . 's' . DIRECTORY_SEPARATOR . explode('/', $book->image_small)[2],
                    $books_covers_path . DIRECTORY_SEPARATOR . 's_selected' . DIRECTORY_SEPARATOR . explode('/', $book->image_small)[2]);
                File::move($books_covers_path . DIRECTORY_SEPARATOR . 'm' . DIRECTORY_SEPARATOR . explode('/', $book->image_medium)[2],
                    $books_covers_path . DIRECTORY_SEPARATOR . 'm_selected' . DIRECTORY_SEPARATOR . explode('/', $book->image_medium)[2]);
                File::move($books_covers_path . DIRECTORY_SEPARATOR . 'l' . DIRECTORY_SEPARATOR . explode('/', $book->image_large)[2],
                    $books_covers_path . DIRECTORY_SEPARATOR . 'l_selected' . DIRECTORY_SEPARATOR . explode('/', $book->image_large)[2]);
            }

            echo $index . ' - ' . explode('/', $book->image_small)[2] . PHP_EOL;
        }

        foreach ($all_books as $index => $book) {
            if (!file_exists($books_covers_path . DIRECTORY_SEPARATOR . 's_selected' . DIRECTORY_SEPARATOR . explode('/', $book->image_small)[2])) {
                DB::table('books')->where('id', '=', $book->id)->update([
                    'image_small' => DB::raw('NULL'),
                    'image_medium' => DB::raw('NULL'),
                    'image_large' => DB::raw('NULL'),
                ]);
            }
        }
    }
}
