<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
   return view('welcome');
   #return "Hi Kate";
});

/* First example of linking a route to a controller */
/* References /app/Http/Controllers/BookController.php */
Route::get('/books', 'BookController@index')->name('books.index');

Route::get('/books/create', function() {

    $view  = '<form method="POST" action="/books/create">';
    $view .= csrf_field(); # This will be explained more later
    $view .= '<label>Title: <input type="text" name="title"></label>';
    $view .= '<input type="submit">';
    $view .= '</form>';
    return $view;

});

Route::post('/books/create', function() {

    dd(Request::all());

});


Route::get('/books/show/{title}', function($title) {
    return 'Results for the book: '.$title;
});

/*
Route::get('/books/{title?}', function($title = '') {

	if ($title == '') {
		return "You did not includea title.";
	}

	return "You requested the book:".$title;

})->name('books.show');
*/

/* Route taken from the notes on views 
https://github.com/susanBuck/dwa15-fall2016-notes/blob/master/03_Laravel/15_Views_and_Blade.md*/

Route::get('/books/{title}', 'BookController@show')->name('books.show');
Route::get('/books', 'BookController@index')->name('books.index');
Route::get('/books/create', 'BookController@create')->name('books.create');
Route::get('/books/{title}/edit', 'BookController@edit')->name('books.edit');

/* Debugbar feature demo route
see https://github.com/susanBuck/dwa15-fall2016-notes/blob/master/03_Laravel/14_Composer_Packages.md */

Route::get('/debugbar', function() {

    $data = Array('foo' => 'bar');
    Debugbar::info($data);
    Debugbar::info('Current environment: '.App::environment());
    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');

    return 'Just demoing some of the features of Debugbar';

});

/* rych-random demo route
see https://github.com/susanBuck/dwa15-fall2016-notes/blob/master/03_Laravel/14_Composer_Packages.md */

Route::get('/random', function() {

    $random = new Rych\Random\Random();
    return $random->getRandomString(8);

});

/**
* A quick and dirty way to set up a whole bunch of practice routes
* that I'll use in lecture.
*/
Route::get('/practice', 'PracticeController@index')->name('practice.index');
for($i = 0; $i < 100; $i++) {
    Route::get('/practice/'.$i, 'PracticeController@example'.$i)->name('practice.example'.$i);
}
/*
# View all books
Route::get('/books', function() {

})->name('books.index');

# Display form to add a new book
Route::get('/books/create', function() {

})->name('books.create');
*/
# Process form to add a new book
# Edited to ape Susan's code from 10/13 - lecture 7
Route::post('/books', 'BookController@store')->name('books.store');
/*
# Display an individual book
Route::get('/books/{book}', function($book) {

})->name('books.show');

# Display form to edit an individual book
Route::get('/books/{book}/edit', function($book) {

})->name('books.edit');

# Process form to save edits to an individual book
Route::put('/books/{book}', function($book) {

})->name('books.update');

# Delete an individual book
Route::delete('/books/{book}', function($book) {

})->name('books.destroy');
*/
