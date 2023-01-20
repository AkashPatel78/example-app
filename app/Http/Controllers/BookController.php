<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cat;
use App\Models\Author;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function book()
    {
        $data['cat'] = Cat::where('status',1)->get();
        $data['auther'] = Author::where('status',1)->get();
        return view('book')->with($data);
    }

    // handle fetch all book ajax request
    public function fetchAll()
    {
        $emps = Book::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Authors</th>
                <th>Book Pdf</th>

                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $cat_name = Cat::where('id', $emp->cat_id)->value('name');
                $auther_name = Author::where('id', $emp->auther_id)->value('name');
                 $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td><img src="/storage/images/' . $emp->avatar . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $emp->name . '</td>
                <td>' .    $cat_name . '</td>
                <td>' .   $auther_name . '</td>
                <td>' . $emp->pdf . '</td>

                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new book ajax request
    public function store(Request $request)
    {


        $validation = Validator::make($request->all(), [
            'avatar' => 'required|mimes:png,jpg',
            'pdf' => 'required|mimes:pdf',


        ]);

        if ($validation->fails()) {
            return "error";
        } else {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);

            $fileT = $request->file('pdf');
            $fileNameT = time() . '.' . $fileT->getClientOriginalExtension();
            $fileT->storeAs('public/pdf', $fileNameT);

            $empData = ['name' => $request->name, 'cat_id' => $request->cat_id, 'auther_id' => $request->auther_id,  'avatar' => $fileName, 'pdf' => $fileNameT];
            Book::create($empData);
            return response()->json([
                'status' => 200,
            ]);
        }
    }


    // edit an book
    public function edit(Request $request)
    {

        $id = $request->id;
        $emp = Book::find($id);
        return response()->json($emp);
    }

    // update an book
    public function update(Request $request)
    {
        $fileName = '';
        $emp = Book::find($request->emp_id);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($emp->avatar) {
                Storage::delete('public/images/' . $emp->avatar);
            }
        } else {
            $fileName = $request->emp_avatar;
        }

        $empData = ['name' => $request->name, 'cat_id' => $request->cat_id,  'auther_id' => $request->auther_id,  'avatar' => $fileName];

        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Book::find($id);
        if (Storage::delete('public/images/' . $emp->avatar)) {
            Book::destroy($id);
        }
    }
}
