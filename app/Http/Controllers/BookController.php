<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class BookController extends Controller {
    private $bookRepository;

    public function __construct(BookRepository $bookRepository) {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }

    public function count() {
        $response = $this->bookRepository->count();
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function borrowedCount() {
        $response = $this->bookRepository->borrowedCount();
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function nonReturnCount() {
        $response = $this->bookRepository->nonReturnCount();
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function borrowedGraph(Request $request) {
        $mode = $request->get('mode', BookRepository::GRAPH_MODE_MONTH);
        $value = $request->get('value', date('m'));
        $response = $this->bookRepository->borrowedGraph($mode, $value);
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function popular() {
        $response = $this->bookRepository->popular();
        return response()->json($response["data"], $response["statusCode"]);
    }
}
