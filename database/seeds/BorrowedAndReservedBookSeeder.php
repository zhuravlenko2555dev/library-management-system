<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class BorrowedAndReservedBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $faker = Factory::create();

        $borrowed_books_data = [];

        $start = new DateTime('-1 year');
        $start->modify('first day of this month');
        $end = new DateTime('now');
        $end->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);
        $now_dt = new DateTime('now');
        $current_day = $now_dt->format("d");
        $days_in_current_month = cal_days_in_month(CAL_GREGORIAN, $now_dt->format("m"), $now_dt->format("Y"));

        $index_for_reading = $current_day >= 2 ? 12 : 11;
        $bi_ids_for_ran_out_books = [];

        foreach ($period as $index => $dt) {
            if ($index == 12 & $index_for_reading == 11) break;

            $p = 0.5;

            if ($index == $index_for_reading) {
                $p = $p * (($current_day - 1) >= 10 ? 10 : ($current_day - 1)) / $days_in_current_month;
            }

            if ($index == $index_for_reading) {
                $bi_ids_for_ran_out_books = DB::table('book_items')
                    ->join('books', 'book_items.book_id', '=', 'books.id')
                    ->whereIn('books.id', function (Illuminate\Database\Query\Builder $query) {
                        $query->select('b.id')
                            ->from(function (Illuminate\Database\Query\Builder $query2) {
                                $query2->select('books.id', DB::raw('COUNT(borrowed_books.id) AS count'))
                                    ->from('books')
                                    ->join('book_items', 'books.id', '=', 'book_items.book_id')
                                    ->leftJoin('borrowed_books', 'book_items.id', '=', 'borrowed_books.bookItem_id')
                                    ->groupBy('books.id')
                                    ->having('count', '=', 0)
                                    ->orderByRaw('RAND()')
                                    ->limit(5);
                            }, 'b');
                    })
                    ->select('book_items.id')
                    ->get()->pluck('id');
            }

            $readers_builder = DB::table('users')
                ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                ->where('user_roles.role_id', '=', 3)
                ->whereNotNull('email_verified_at')
                ->select('users.id');
            if ($index == $index_for_reading) {
                $readers_builder->orderByRaw('RAND()')
                    ->limit(count($bi_ids_for_ran_out_books));
            } else {
                $readers_builder->havingRaw('RAND() > ' . (1 - $p))
                    ->orderByRaw('RAND()');
            }
            $readers = $readers_builder->get()->pluck('id');

            $bi_ids = null;
            if ($index == $index_for_reading) {
                $bi_ids = $bi_ids_for_ran_out_books;
            } else {
                $bi_ids = DB::table('books')
                    ->joinSub('(SELECT book_items.id, book_items.book_id, book_items.number FROM book_items ORDER BY RAND())', 'bi', 'books.id', '=', 'bi.book_id')
                    ->groupBy('books.id')
                    ->orderByRaw('RAND()')
                    ->limit(count($readers))
                    ->select('bi.id')
                    ->get()->pluck('id');
            }

            $days_in_month = cal_days_in_month(CAL_GREGORIAN, $dt->format("m"), $dt->format("Y"));
            $year = $dt->format("Y");
            $month = $dt->format("m");

            for ($i = 0; $i < count($readers); $i++) {
                if ($index == $index_for_reading) {
                    if (($current_day - 1) >= 10) {
                        $day = $faker->numberBetween(($current_day - 10), ($current_day - 1));
                    } else {
                        $day = $faker->numberBetween(1, ($current_day - 1));
                    }
                } else {
                    $day = $faker->numberBetween(1, $days_in_month);
                }
                $time_str = str_pad($faker->numberBetween(9, 18), 2, "0", STR_PAD_LEFT)
                    . ":" . str_pad($faker->numberBetween(0, 59), 2, "0", STR_PAD_LEFT)
                    . ":" . str_pad($faker->numberBetween(0, 59), 2, "0", STR_PAD_LEFT);
                $to_dt = clone $dt;
//                $to_dt->modify('first day of this month');
                $period = $faker->numberBetween(5, 7);
//                $to_d = $day + $period;
//                $to_dt->add(new DateInterval("P{$to_d}D"));
                $to_dt->modify("+{$period} days");

                $to_year = $to_dt->format("Y");
                $to_month = $to_dt->format("m");
                $to_day = $to_dt->format("d");

                $val = [
                    'bookItem_id' => $bi_ids[$i],
                    'borrower_id' => $readers[$i],
                    'librarian_id' => $faker->numberBetween(2, 6),
                    'from_date' => "$year-$month-$day " . $time_str,
                    'to_date' => "$to_year-$to_month-$to_day " . $time_str,
                ];

                if ($index == $index_for_reading) {
                    $val['status'] = 'reading';

                    $val['date_of_return'] = DB::raw('NULL');
                    $val['fine'] = DB::raw('NULL');
                    $val['paid'] = DB::raw('NULL');
                } else {
                    if ($faker->boolean(99)) {
                        $val['status'] = 'returned';

                        if ($faker->boolean(95)) {
                            $d = $faker->numberBetween(0, ($period - 2));
                            $to_dt->modify("-{$d} days");

                            $r_year = $to_dt->format("Y");
                            $r_month = $to_dt->format("m");
                            $r_day = $to_dt->format("d");

                            $val['date_of_return'] = "$r_year-$r_month-$r_day " . $time_str;
                            $val['fine'] = DB::raw('NULL');
                            $val['paid'] = DB::raw('NULL');
                        } else {
                            $d = $faker->numberBetween(1, 5);
                            $to_dt->modify("+{$d} days");

                            $r_year = $to_dt->format("Y");
                            $r_month = $to_dt->format("m");
                            $r_day = $to_dt->format("d");

                            $fine = $d * 0.25;

                            $val['date_of_return'] = "$r_year-$r_month-$r_day " . $time_str;
                            $val['fine'] = $fine;
                            $val['paid'] = $faker->boolean;
                        }
                    } else {
                        $val['status'] = 'lost';

                        $d = $faker->numberBetween(1, 5);
                        $to_dt->modify("+{$d} days");

                        $r_year = $to_dt->format("Y");
                        $r_month = $to_dt->format("m");
                        $r_day = $to_dt->format("d");

                        $fine = $faker->numberBetween(5, 15);

                        $val['date_of_return'] = "$r_year-$r_month-$r_day " . $time_str;
                        $val['fine'] = $fine;
                        $val['paid'] = $faker->boolean;
                    }
                }

                if ($faker->boolean(5)) {
                    $val['note'] = $faker->text;
                } else {
                    $val['note'] = DB::raw('NULL');
                }

                array_push($borrowed_books_data, $val);
            }
        }

        usort($borrowed_books_data, function($a1, $a2) {
            $v1 = strtotime($a1['from_date']);
            $v2 = strtotime($a2['from_date']);
            return $v1 - $v2;
        });

        foreach (array_chunk($borrowed_books_data,1000) as $data) {
            DB::table('borrowed_books')->insert($data);
        }

        $reserved_books_data = [];

        $readers_for_reserved = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->leftJoin('borrowed_books', 'users.id', '=', 'borrowed_books.borrower_id')
            ->where('user_roles.role_id', '=', 3)
            ->whereNotNull('email_verified_at')
            ->whereNotIn('users.id', function (Illuminate\Database\Query\Builder $query) {
                $query->select('borrowed_books.borrower_id')
                    ->from('borrowed_books')
                    ->where('borrowed_books.status', 'like', 'reading');
            })
            ->select('users.id')
            ->orderByRaw('RAND()')
            ->limit(12)
            ->get()->pluck('id');

        $books_for_reserved = DB::table('books')
            ->join('book_items', 'books.id', '=', 'book_items.book_id')
            ->join('borrowed_books', 'book_items.id', '=', 'borrowed_books.bookItem_id')
            ->where('borrowed_books.status', 'like', 'reading')
            ->groupBy('books.id')
            ->select('books.id')
            ->get()->pluck('id');

        for ($i = 0; $i < count($readers_for_reserved); $i++) {
            $val = [
                'book_id' => $books_for_reserved[$i % 5],
                'reserved_by' => $readers_for_reserved[$i]
            ];

            array_push($reserved_books_data, $val);
        }

        DB::table('reserved_books')->insert($reserved_books_data);
    }
}
