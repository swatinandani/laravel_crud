<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function index(Request $request) { 
       
        if ($request->ajax()) {
            $products = DB::table('products')            
            ->join('categories','categories.id','products.catid')
            ->select('products.*','categories.name as catname')->get();
           // $products = Product::with('categories')->get();
           
            return Datatables::of($products)
                    ->addIndexColumn()
                   
                    ->addColumn('action', function($row) {                                              
                           $btn = '<button type="button" class="btn btn-success btn-sm" id="getEditArticleData" data-bs-target="#EditArticleModal" data-id="'.$row->id.'">Edit</button>&nbsp;
                           <button type="button" data-id="'.$row->id.'" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
                           return $btn;
                    })
                    ->addColumn('image', function ($row) { 
                        $url= asset('images/product/'.$row->images);
                        return '<img src="'.$url.'" border="0" width="90" class="img-rounded" align="center" />';
                    })
                    ->addColumn('status', function($row) {
                        if ($row->status == 1) {
                            $status = '<button type="button" class="btn btn-outline-primary">Active</button>';
                        } else {
                            $status = '<button type="button" class="btn btn-outline-danger">InActive</button>';
                        }
                        return $status;
                    })
                    ->rawColumns(['action','status','image'])
                    ->make(true);
        }
   
       
        return view('articles.index');
    }

    public function create()
    {    
        $category = Category::all();
        $html = '<select class="form-control" name="catid" id="editCatid">';
        $html .= '<option>Select Category</option>';
        foreach($category as $cat){
            $html .= '<option value="'.$cat->id.'">'.$cat->name.'</option>';
        }
        $html .= '</select>';
        return response()->json(['html'=>$html]);
    }

    public function store(Request $request){
        $SuccessFlag = 1;
        $Message = '';
   
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
        ]);
        if ($validator->passes()) {
           
           
        
        if ($files = $request->file('images')) {
           
            $image = $request->file('images');
           // $filename = $image->getClientOriginalName();
            $image->move(public_path('images'), $filename);        
           
        }
       
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'catid' => $request->catid,
           // 'images' =>$request->file('images')->getClientOriginalName(),
        ]);       
        return response()->json(['success'=>'Product added successfully']);
    }else{
        return response()->json(['errors' => $validator->errors()->all()]);
    }
   
 }
  public function edit($id)
    {   
        $data = DB::table('products')            
        ->join('categories','categories.id','products.catid')
        ->select('products.*','categories.name as catname','categories.id as catid')
        ->where('products.id',$id)
        ->first();
       
        $html = '<div class="form-group">
                    <label for="Title">Title:</label>
                    <input type="text" class="form-control" name="name" id="editTitle" value="'.$data->name.'">
                </div>
                <div class="form-group">
                    <label for="Title">Category Name:</label>
                    <select class="form-control" name="catid" id="editCatid">
                    <option value="'.$data->catid.'">'.$data->catname.'</option>
                    </select>
                   
                </div>
                <div class="form-group">
                    <label for="Name">Description:</label>
                    <textarea class="form-control" name="description" id="editDescription">'.$data->description.'                       
                    </textarea>
                </div>
                <div class="form-group">
                <label for="Title">Status:</label>
                <select class="form-select" name="status" id="editstatus">
                <option value="1">Active</option>
                <option value="0">InActive</option>
                </select>
            </div>';
 
        return response()->json(['html'=>$html]);
    }

    public function update(Request $request, $id)
    {              
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
       
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }else{  
             Product::find($id)->update([
            'name' => $request->name,
            'catid' => $request->catid,
            'description' =>$request->description,
            'status' =>$request->status,
        ]);
     }
        return response()->json(['success'=>'Product updated successfully']);
    }
      
 
}
