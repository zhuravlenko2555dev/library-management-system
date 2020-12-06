<?php

namespace App\Repositories;

use DB;

class BookRepository extends BaseRepository {
    public const GRAPH_MODE_MONTH = 0;
    public const GRAPH_MODE_YEAR = 1;

    public function count() {
        $readersCount = DB::table('books')->count();
        return $this->response($readersCount, self::SUCCUSUS_STATUS_CODE);
    }

    public function borrowedCount() {
        $borrowedCount = DB::table('borrowed_books')
            ->where('status', 'like', 'reading')
            ->count();
        return $this->response($borrowedCount, self::SUCCUSUS_STATUS_CODE);
    }

    public function nonReturnCount() {
        $nonReturnCount = DB::table('borrowed_books')
            ->where('status', 'like', 'reading')
            ->whereRaw('TIMESTAMPDIFF(SECOND, to_date, NOW()) > 0')
            ->count();
        return $this->response($nonReturnCount, self::SUCCUSUS_STATUS_CODE);
    }

    public function borrowedGraph($mode, $value) {
        if ($mode == self::GRAPH_MODE_YEAR) {
            $borrowedGraph = DB::table('borrowed_books')
                ->select([DB::raw('COUNT(borrowed_books.id) as value'), DB::raw('MONTHNAME(borrowed_books.from_date) as label')])
                ->whereRaw("YEAR(borrowed_books.from_date) = $value")
                ->groupBy('label')
                ->get();
        } else {
            $borrowedGraph = DB::table('borrowed_books')
                ->select([DB::raw('COUNT(borrowed_books.id) as value'), DB::raw('DAY(borrowed_books.from_date) as label')])
                ->whereRaw("MONTH(borrowed_books.from_date) = $value")
                ->whereRaw('YEAR(borrowed_books.from_date) = YEAR(NOW())')
                ->groupBy('label')
                ->get();
        }
        return $this->response($borrowedGraph, self::SUCCUSUS_STATUS_CODE);
    }

    public function popular() {
        $popular = DB::table('books')
            ->select(['books.*', DB::raw('count(borrowed_books.id) as count_of_reads')])
            ->join('book_items', 'books.id', '=', 'book_items.book_id')
            ->join('borrowed_books', 'book_items.id', '=', 'borrowed_books.bookItem_id')
            ->groupBy('books.id')
            ->orderBy('count_of_reads', 'desc')
            ->limit(10)
            ->get();
        return $this->response($popular, self::SUCCUSUS_STATUS_CODE);
    }
}
