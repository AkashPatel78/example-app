<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use DataTables;
use Validator;

class UserController extends Controller
{

    public function index()
    {
        $cat = User::all();
        return view('admin/user');
    }



    function regUser()
    {
        // return DataTables::of(Student::query())->make(true);
        $query = DB::table("users");
        $rows = $query->get();

        return DataTables()->of($rows)->addIndexColumn()

            ->addColumn('action', function ($data) {
                $updateButton = '<a href="#" id="' . $data->id . '" class="btn btn-outline-info editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal">View</a>';
                return $updateButton;
            })

            ->rawColumns(['id', 'name', 'email', 'action'])
            ->make(true);
    }
    public function rentBook(Request $request)
    {

        $auth_id = Auth::user()->id;
        $request->id;
        $data = DB::table('orders')->join('users', 'users.id', 'orders.user_id')
            ->join('books', 'books.id', 'orders.book_id')
            ->select('users.name as user', 'books.name as bookName', 'books.id', 'books.name', 'books.avatar', 'books.pdf', 'orders.id as ord_id')->where('user_id', $auth_id)->get();

        return response()->json($data);
    }

    // handle update an auther ajax request
    public function update(Request $request)
    {
        $cat = User::find($request->id);
        $catData = ['name' => $request->name, 'status' => $request->status];
        $cat->update($catData);
        return response()->json([
            'status' => 200,
        ]);
    }
    //Git hub njsdnjsndj

}
