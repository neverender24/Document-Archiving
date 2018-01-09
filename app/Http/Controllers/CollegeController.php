<?php

namespace App\Http\Controllers;

use App\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function index()
    {
    	$data = College::all();

    	return view('admin.college.index', compact('data'));
    }

    public function create()
    {
    	return view('admin.college.create');
    }

    public function store(Request $request)
    {
    	$create = College::create($request->all());

    	\Session::flash('success','College Added');

    	return redirect('/college');
    }

    public function edit(Request $request, $id)
    {
    	$edit = College::findOrFail($id);

    	return view('admin.college.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
    	$update = College::findOrFail($id);

    	$update->update($request->all());

    	\Session::flash('success','College Updated');

    	return redirect('/college');
    }

    public function destroy($id)
    {
    	$delete = College::findOrFail($id);
    	$delete->delete();

    	\Session::flash('success','College Deleted');

    	return redirect('/college');
    }
}
