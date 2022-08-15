<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
  public function index()
  {
      $books = Book::orderBy('id','desc')->paginate(5);
      return view('book', compact('books'));
  }
}
