<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class BookItemAndShelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $book_items_data = [];
        $shelves_data = [];
        $book_items_shelves_data = [];

        $books_in_shelf = 50;
        $shelves_in_stack = 30;
        $count_all_items = 0;

        $all_books = DB::table('books')->get()->toBase()->toArray();

        foreach ($all_books as $book) {
            $count = $faker->numberBetween(3, 5);
            $book->count_items = $count;
            $count_all_items += $count;

            for ($z = 0; $z < $count; $z++) {
                $book_item = [
                    'book_id' => $book->id,
                    'number' => ($z + 1)
                ];

                if ($faker->boolean(1) && $faker->boolean(10)) {
                    $book_item['note'] = $faker->text;
                } else {
                    $book_item['note'] = DB::raw('NULL');
                }

                array_push($book_items_data, $book_item);
            }
        }

        foreach (array_chunk($book_items_data,1000) as $data) {
            DB::table('book_items')->insert($data);
        }

        $c = ceil($count_all_items / ($books_in_shelf * $shelves_in_stack));
        for ($i = 0; $i < $c; $i++) {
            for ($y = 0; $y < $shelves_in_stack; $y++) {
                $shelf = [
                    'name' => 'st-' . ($i + 1) . '_sh-' . ($y + 1)
                ];

                array_push($shelves_data, $shelf);
            }
        }

        foreach (array_chunk($shelves_data,1000) as $data) {
            DB::table('shelves')->insert($data);
        }

        $current_shelf_id = 1;
        for ($x = 0; $x < $count_all_items; $x++) {
            $book_item_shelf = [
                'bookItem_id' => ($x + 1),
                'shelf_id' => $current_shelf_id
            ];

            array_push($book_items_shelves_data, $book_item_shelf);

            if (($x + 1) % $books_in_shelf == 0) {
                $current_shelf_id++;
            }
        }

        foreach (array_chunk($book_items_shelves_data,1000) as $data) {
            DB::table('book_item_shelves')->insert($data);
        }
    }
}
