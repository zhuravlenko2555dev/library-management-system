<?php

use Illuminate\Database\Seeder;

class FromSQLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'dump' . '/authors.sql'));
        DB::unprepared(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'dump' . '/genres.sql'));
        DB::unprepared(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'dump' . '/languages.sql'));
        DB::unprepared(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'dump' . '/publishers.sql'));
        DB::unprepared(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'dump' . '/books.sql'));
        DB::unprepared(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'dump' . '/book_authors.sql'));
        DB::unprepared(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'dump' . '/book_genres.sql'));
        DB::unprepared(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'dump' . '/book_languages.sql'));
        DB::unprepared(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'dump' . '/book_publishers.sql'));
        DB::unprepared(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'dump' . '/all_subjects_data.sql'));
    }
}
