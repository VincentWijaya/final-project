<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
  public function index()
  {
      $books = Book::orderBy('id','desc')->paginate(5);
      return view('book', compact(['books']));
  }

  public function create(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'authors' => 'required',
      'publisher' => 'required',
      'published' => 'required',
      'isbn' => 'required'
    ]);

    $book = new Book;
    $book->name = $request['name'];
    $book->authors = $request['authors'];
    $book->publisher = $request['publisher'];
    $book->published = $request['published'];
    $book->isbn = $request['isbn'];
    $book->save();

    return redirect()->route('book')->with('success','Book has been created successfully.');
  }

  public function destroy($id)
  {
    $book = Book::findOrFail($id);
    $book->delete();
    
    if ($book) {
      return redirect()->route('book')->with('success','Book has been deleted successfully');
    }

    return redirect()->route('book')->with('error','Some problem has occurred, please try again');
  }

  public function update(Request $request, $id) {
    dump($request);
    $book = Book::find($request->id);
    $book->name = $request['name'];
    $book->authors = $request['authors'];
    $book->publisher = $request['publisher'];
    $book->published = $request['published'];
    $book->isbn = $request['isbn'];
    $book->status = $request['status'];
    $book->save();

    return redirect()->route('book')->with('success','Book has been updated successfully.');
  }
}
