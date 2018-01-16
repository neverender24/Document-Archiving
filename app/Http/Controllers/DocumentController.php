<?php

namespace App\Http\Controllers;

use App\Category;
use App\Document;
use App\Drawer;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $search = \Request::get('search');

    	$data = Document::with('drawer')->with('user')->where('subject','like','%'.$search.'%')->get();
    	
    	return view('admin.document.index', compact('data'));
    }

    public function create()
    {
    	$categories = Category::pluck('description','id')->toArray();
    	$drawers = Drawer::where('user_id', \Auth::user()->id)->pluck('description','id')->toArray();

    	return view('admin.document.create', compact('drawers', 'categories'));
    }

    public function store(Request $request)
    {
    	$request['user_id'] = \Auth::user()->id;
    	$create = Document::create($request->all());

    	\Session::flash('success','Document Added');

    	return redirect('/document');
    }

    public function edit(Request $request, $id)
    {
        $categories = Category::pluck('description','id')->toArray();
    	$drawers = Drawer::where('user_id', \Auth::user()->id)->pluck('description','id')->toArray();

    	$edit = Document::findOrFail($id);

    	return view('admin.document.edit', compact('edit','drawers','categories'));
    }

    public function update(Request $request, $id)
    {
    	$update = Document::findOrFail($id);

    	$update->update($request->all());

    	\Session::flash('success','Document Updated');

    	return redirect('/document');
    }

    public function destroy($id)
    {
    	$delete = Document::findOrFail($id);
    	$delete->delete();

    	\Session::flash('success','Document Deleted');

    	return redirect('/document');
    }
}
