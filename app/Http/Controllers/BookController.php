<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BookController extends Controller
{

    /**
    * Responds to requests to GET /books
    */
    public function index()
    {
        return 'Display all the books';
    }

    /**
    * Displays the specified resource.
    *
    * @param int $title
    * @return \Illuminate\Http\Response
    */
    public function show($title)
    {
	#return 'Show book '.$title;
	return view('books.show')->with('title', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
           return 'Process adding new book: '.$_POST['title'];
     }
} # end of class
