<?php

use Illuminate\Database\Seeder;
use \GuzzleHttp\Client;

class ISBNSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $endpoint = 'https://openlibrary.org/api/books';
        $client = new Client();
        $cnt = 0;

        $all_books = DB::table('books')->orderBy('id')->chunk(100, function ($books) use ($endpoint, $client, &$cnt) {
            $olids = '';
            foreach ($books as $book) {
                $olids .= 'OLID:' . $book->olid . ',';
            }
            $response = $client->request('GET', $endpoint, ['query' => [
                'bibkeys' => $olids,
                'format' => 'json',
                'jscmd' => 'data',
            ]]);//            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody(), true);
            foreach ($content as $key => $data) {
                $isbn_value = '';
                if (isset($data['identifiers']['isbn_10'])) {
                    $isbn_value = $data['identifiers']['isbn_10'][0];
                } else if (isset($data['identifiers']['isbn_13'])) {
                    $isbn_value = $data['identifiers']['isbn_13'][0];
                }
                if (!empty($isbn_value)) {
                    try {
                        DB::table('books')->where('olid', 'like', explode(':', $key)[1])->update(['isbn' => $isbn_value]);
                    } catch (Illuminate\Database\QueryException $e) {
                    }
                }
            }

            $cnt++;
            echo $cnt . PHP_EOL;

            if ($cnt % 20 == 0) {
                sleep(12);
            } else {
                sleep(2);
            }
        });
    }
}
