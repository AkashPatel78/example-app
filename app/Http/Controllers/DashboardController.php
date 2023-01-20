<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Author;
use App\Models\Cat;
use App\Models\Book;
use App\Models\User;
class DashboardController extends Controller
{
    public function dashboard() {
        $data['book']=Book::count();
        $data['category']= Cat::count();
        $data['catActive']= Cat::where('status',1)->count();
        $data['catInActive']= Cat::where('status',0)->count();

        $data['authors']= Author::count();
        $data['authActive']= Author::where('status',1)->count();
        $data['authInActive']= Author::where('status',0)->count();

        $data['users']= User::count();


        return view('admin.dashboard',$data);
    }
}
