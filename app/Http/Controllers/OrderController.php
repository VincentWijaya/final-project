<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
  public function index() {
    $userId = Auth::id();
    $orders = Order::where('user_id', $userId)->paginate(5);
    return view('order', compact(['orders']));
  }

  public function create($book_id) {
    $userId = Auth::id();

    $order = new Order;
    $order->book_id = $book_id;
    $order->user_id = $userId;
    $order->save();

    $book = Book::find($book_id);
    $book->status = 'Rented';
    $book->save();

    return redirect()->route('book')->with('success','Book has been rented successfully.');
  }

  public function return($order_id) {
    $userId = Auth::id();

    $order = Order::find($order_id);
    $order->status = 'Returned';
    $order->save();

    $book = Book::find($order->book_id);
    $book->status = 'Available';
    $book->save();

    return redirect()->route('book')->with('success','Book has been return successfully.');
  }
}