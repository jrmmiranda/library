<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;

class BookController extends Controller
{
	protected function validateRequest()
	{
		return request()->validate([
    		'title' => 'required',
    		'author' => 'required'
    	]);
	}

    public function store()
    {
    	Book::create($this->validateRequest());
    }

    public function update(Book $book)
    {
    	$book->update($this->validateRequest());
    }
}
