<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
 public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$data = Category::all();

    	return view('admin.category.index', compact('data'));
    }

    public function create()
    {
    	return view('admin.category.create');
    }

    public function store(Request $request)
    {
    	$create = Category::create($request->all());

    	\Session::flash('success','Category Added');

    	return redirect('/category');
    }

    public function edit(Request $request, $id)
    {
    	$edit = Category::findOrFail($id);

    	return view('admin.category.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
    	$update = Category::findOrFail($id);

    	$update->update($request->all());

    	\Session::flash('success','Category Updated');

    	return redirect('/category');
    }

    public function destroy($id)
    {
    	$delete = Category::findOrFail($id);
    	$delete->delete();

    	\Session::flash('success','Category Deleted');

    	return redirect('/category');
    }
}
