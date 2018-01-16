<?php

namespace App\Http\Controllers;

use App\Category;
use App\Drawer;
use Illuminate\Http\Request;

class DrawerController extends Controller
{
    public function index()
    {
    	$data = Drawer::with('category')->where('user_id', \Auth::user()->id)->get();

    	return view('admin.drawer.index', compact('data'));
    }

    public function create()
    {
    	$categories = Category::pluck('description','id')->toArray();

    	return view('admin.drawer.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request['user_id'] = \Auth::user()->id;

    	$create = Drawer::create($request->all());

    	\Session::flash('success','Drawer Added');

    	return redirect('/drawer');
    }

    public function edit(Request $request, $id)
    {
    	$categories = Category::pluck('description','id')->toArray();

    	$edit = Drawer::findOrFail($id);

    	return view('admin.drawer.edit', compact('edit','categories'));
    }

    public function update(Request $request, $id)
    {
    	$update = Drawer::findOrFail($id);

        $request['user_id'] = \Auth::user()->id;

    	$update->update($request->all());

    	\Session::flash('success','Drawer Updated');

    	return redirect('/drawer');
    }

    public function destroy($id)
    {
    	$delete = Drawer::findOrFail($id);
    	$delete->delete();

    	\Session::flash('success','Drawer Deleted');

    	return redirect('/drawer');
    }
}
