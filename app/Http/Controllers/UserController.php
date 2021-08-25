<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users', compact('users'));
    }

    public function export(){
        return Excel::download(new UsersExport, 'users.xls');
    }

    public function importUser(){
        return view('import');
    }

    public function import(Request $request){
        Excel::import(new UsersImport, $request->file('file'));
        return back()->with('success', 'Users imported successfully');
    }
}
