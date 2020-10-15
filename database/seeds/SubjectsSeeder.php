<?php

use App\Models\Subject;
use App\Models\SubjectPeople;
use App\Models\SubjectPlace;
use App\Models\SubjectTime;
use Illuminate\Database\Seeder;
use \GuzzleHttp\Client;

class SubjectsSeeder extends Seeder
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
            $olids_bookId = [];
            foreach ($books as $book) {
                $olids .= 'OLID:' . $book->olid . ',';
                $olids_bookId[$book->olid] = $book->id;
            }
            $response = $client->request('GET', $endpoint, ['query' => [
                'bibkeys' => $olids,
                'format' => 'json',
                'jscmd' => 'data',
            ]]);
            $content = json_decode($response->getBody(), true);
            foreach ($content as $key => $data) {
                $subjects = [];
                $subject_places = [];
                $subject_people = [];
                $subject_times = [];

                $subjects_ids = [];
                $subject_places_ids = [];
                $subject_people_ids = [];
                $subject_times_ids = [];

                $book_subjects_data = [];
                $book_subject_places_data = [];
                $book_subject_people_data = [];
                $book_subject_times_data = [];

                if (isset($data['subjects'])) {
                    $subjects = $data['subjects'];
                }
                if (isset($data['subject_places'])) {
                    $subject_places = $data['subject_places'];
                }
                if (isset($data['subject_people'])) {
                    $subject_people = $data['subject_people'];
                }
                if (isset($data['subject_times'])) {
                    $subject_times = $data['subject_times'];
                }

                if (!empty($subjects)) {
                    foreach ($subjects as $subject) {
                        $url_array = explode('/', $subject['url']);
                        if (count($url_array) == 5) {
                            $alias = end($url_array);
                            $name = $subject['name'];

                            $subjectModel = Subject::query()->firstOrCreate(['alias' => $alias], ['name' => $name]);

                            if (!in_array($subjectModel->id, $subjects_ids)) {
                                array_push($subjects_ids, $subjectModel->id);

                                $book_subject = [
                                    'book_id' => $olids_bookId[explode(':', $key)[1]],
                                    'subject_id' => $subjectModel->id
                                ];
                                array_push($book_subjects_data, $book_subject);
                            }
                        }
                    }
                }
                if (!empty($subject_places)) {
                    foreach ($subject_places as $subject_place) {
                        $url_array = explode('/', $subject_place['url']);
                        if (count($url_array) == 5) {
                            $alias = explode(':', end($url_array))[1];
                            $name = $subject_place['name'];

                            $subjectPlaceModel = SubjectPlace::query()->firstOrCreate(['alias' => $alias], ['name' => $name]);

                            if (!in_array($subjectPlaceModel->id, $subject_places_ids)) {
                                array_push($subject_places_ids, $subjectPlaceModel->id);

                                $book_subject_place = [
                                    'book_id' => $olids_bookId[explode(':', $key)[1]],
                                    'subjectPlace_id' => $subjectPlaceModel->id
                                ];
                                array_push($book_subject_places_data, $book_subject_place);
                            }
                        }
                    }
                }
                if (!empty($subject_people)) {
                    foreach ($subject_people as $subject_people_elem) {
                        $url_array = explode('/', $subject_people_elem['url']);
                        if (count($url_array) == 5) {
                            $alias = explode(':', end($url_array))[1];
                            $name = $subject_people_elem['name'];

                            $SubjectPeopleModel = SubjectPeople::query()->firstOrCreate(['alias' => $alias], ['name' => $name]);

                            if (!in_array($SubjectPeopleModel->id, $subject_people_ids)) {
                                array_push($subject_people_ids, $SubjectPeopleModel->id);

                                $book_subject_people = [
                                    'book_id' => $olids_bookId[explode(':', $key)[1]],
                                    'subjectPeople_id' => $SubjectPeopleModel->id
                                ];
                                array_push($book_subject_people_data, $book_subject_people);
                            }
                        }
                    }
                }
                if (!empty($subject_times)) {
                    foreach ($subject_times as $subject_time) {
                        $url_array = explode('/', $subject_time['url']);
                        if (count($url_array) == 5) {
                            $alias = explode(':', end($url_array))[1];
                            $name = $subject_time['name'];

                            $subjectTimeModel = SubjectTime::query()->firstOrCreate(['alias' => $alias], ['name' => $name]);

                            if (!in_array($subjectTimeModel->id, $subject_times_ids)) {
                                array_push($subject_times_ids, $subjectTimeModel->id);

                                $book_subject_time = [
                                    'book_id' => $olids_bookId[explode(':', $key)[1]],
                                    'subjectTime_id' => $subjectTimeModel->id
                                ];
                                array_push($book_subject_times_data, $book_subject_time);
                            }
                        }
                    }
                }

                if (!empty($book_subjects_data)) DB::table('book_subjects')->insert($book_subjects_data);
                if (!empty($book_subject_places_data)) DB::table('book_subject_places')->insert($book_subject_places_data);
                if (!empty($book_subject_people_data)) DB::table('book_subject_people')->insert($book_subject_people_data);
                if (!empty($book_subject_times_data)) DB::table('book_subject_times')->insert($book_subject_times_data);
            }

            $cnt++;
            echo $cnt . PHP_EOL;

            if ($cnt % 20 == 0) {
                sleep(15);
            } else {
                sleep(3);
            }
        });
    }
}
