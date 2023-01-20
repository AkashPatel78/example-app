<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Cat;
use App\Models\Order;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if ($request->id) {

            $data['category'] = Cat::get();
            $data['books'] = Book::join('cats', 'cats.id', 'books.cat_id')->join('authors', 'authors.id', 'books.auther_id')
                ->select('authors.name as author', 'cats.name as category', 'books.id', 'books.name', 'books.avatar as avatar')->where('cat_id', $request->id)->get();

            //return view('home')->with($data);
        } else {


            $data['category'] = Cat::get();
            $data['books'] = Book::join('cats', 'cats.id', 'books.cat_id')->join('authors', 'authors.id', 'books.auther_id')
                ->select('authors.name as author', 'cats.name as category', 'books.id', 'books.name', 'books.avatar')->get();

            // return view('home')->with($data);
        }


        $auth_id = Auth::user()->id;

        $data['order_one'] = Order::join('users', 'users.id', 'orders.user_id')
            ->join('books', 'books.id', 'orders.book_id')
            ->select('users.name as user', 'books.name as bookName', 'books.id', 'books.name', 'books.avatar', 'books.pdf', 'orders.id as ord_id')->where('user_id', $auth_id)->where('status', 0)->get();

        $data['history'] = Order::join('users', 'users.id', 'orders.user_id')
            ->join('books', 'books.id', 'orders.book_id')
            ->select('users.name as user', 'books.name as bookname', 'books.id',  'books.avatar', 'books.pdf', 'orders.id as ord_id', 'leave_date as date','orders.status as button')->where('user_id', $auth_id)->where('status', 1)->get();

        return view('home')->with($data);
    }

    function order(Request $request)
    {
        $order = new Order;
        $auth_id = Auth::user()->id;
        $request->id;
        $order->user_id = $auth_id;
        $order->book_id =   $request->id;

        $check_two_books = Order::where('user_id', $auth_id)->where('status', '0')->count();
        if ($check_two_books == 2) {
            return redirect()->back()->with('message', 'You have already rent two books');
        }
        $check_ordered_book = Order::where('user_id', $auth_id)->where('book_id', $order->book_id)->where('status', '0')->count();

        if ($check_ordered_book > 0) {
            return redirect()->back()->with('message', 'You have already rented this books');
        }

If($check_two_books == 1){
    return redirect()->back()->with('nonState', 'Rented');
}
        $order->save();

        return redirect()->back()->with('message', 'Book Rented Successfully');
    }


    function pdf(Request $request)
    {

        $data['book'] = DB::table('books')->where('id', $request->id)->get();
        return view('pdf')->with($data);
    }



    public function leave(Request $request, $id)
    {

        $date = date("Y/m/d");
        $order = DB::table('orders')->where('id', $id)->update(['status' => 1, 'leave_date' => $date]);

        return redirect()->back()->with('status', 'Leave Book Successfully');
    }
}
