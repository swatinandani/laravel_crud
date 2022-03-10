<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;

class CategoryController extends Controller
{
    public function index(Request $request) { 
       
        if ($request->ajax()) {
            $data = Category::all();
            
            return Datatables::of($data)
                    ->addIndexColumn()
                   
                    ->addColumn('action', function($row) {
                           $btn = '<a href="'. route('category.edit',$row->id).'" class="edit btn btn-primary">
                           Edit
                       </a>&nbsp;<a class="btn btn-danger" onclick="return confirm(\'Are you sure?\')" href="'.route('category.delete', $row->id).'"><i class="fa fa-trash">Delete</i></a>';
                           return $btn;
                    })
                    ->addColumn('status', function($row) {
                        if ($row['status'] == 1) {
                            $status = '<button type="button" class="btn btn-outline-primary">Active</button>';
                        } else {
                            $status = '<button type="button" class="btn btn-outline-danger">InActive</button>';
                        }
                        return $status;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
        }
   
       
        return view('category.index');
}

}
