<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Author;
use DataTables;
use Validator;

class AuthorController extends Controller
{

    public function index()
    {

        return view('admin/author');
    }

    public function form_submit(Request $request)
    {
        $model = new Author();
        $model->name = $request->post('name');
        $model->status = $request->post('status');
        $model->save();
        return ["msg" => "Data Inserted Success"];
    }

    function getRecord()
    {
        // return DataTables::of(Student::query())->make(true);

        $rows = Author::get();
        return DataTables()->of($rows)->addIndexColumn()
        ->addColumn('status', function($rows){

            if($rows->status == 1){
                $badge = '<span class="badge badge-pill badge-success p-2 ml-1">Active</span>';
                return $badge;
            }else{
                $badge = '<span class="badge badge-pill badge-danger p-2">Inactive</span>';
                return $badge;
            }

       })

            ->addColumn('action', function ($data) {
                $updateButton = '<a href="#" id="' . $data->id . '" class="btn btn-outline-success btn-sm text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>';

                 // Delete Button
                 $deleteButton = '<a href="#" id="' . $data->id. '" class="btn btn-outline-danger btn-sm deleteIcon"><i class="bi-trash h4"></i></a>';
                 return $updateButton." ".$deleteButton;


            })

            ->rawColumns(['id', 'name', 'status', 'action'])
            ->make(true);
    }
    public function edit(Request $request)
    {

        $id = $request->id;
        $cat = Author::find($id);
        return response()->json($cat);
    }

    // handle update an auther ajax request
    public function update(Request $request)
    {
        $cat = Author::find($request->id);
        $catData = ['name' => $request->name, 'status' => $request->status];
        $cat->update($catData);
        return response()->json([
            'status' => 200,
        ]);
    }


    public function delete(Request $request)
    {
        $id = $request->id;
        $data = Author::find($id);
        $data->delete();
    }
}
