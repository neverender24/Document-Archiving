<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Response;

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

    	return $create;
    }

    public function edit(Request $request, $id)
    {
    	$edit = Category::findOrFail($id);

    	return $edit;
    }

    public function update(Request $request, $id)
    {
    	$update = Category::findOrFail($id);

    	$update->update($request->all());

    	return $update;
    }

    public function destroy($id)
    {
    	$delete = Category::findOrFail($id);
    	$delete->delete();

    	return $delete;
    }
}
