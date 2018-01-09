<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
    	$data = Office::all();

    	return view('admin.office.index', compact('data'));
    }

    public function create()
    {
    	return view('admin.office.create');
    }

    public function store(Request $request)
    {
    	$create = Office::create($request->all());

    	\Session::flash('success','Office Added');

    	return redirect('/office');
    }

    public function edit(Request $request, $id)
    {
    	$edit = Office::findOrFail($id);

    	return view('admin.office.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
    	$update = Office::findOrFail($id);

    	$update->update($request->all());

    	\Session::flash('success','Office Updated');

    	return redirect('/office');
    }

    public function destroy($id)
    {
    	$delete = Office::findOrFail($id);
    	$delete->delete();

    	\Session::flash('success','Office Deleted');

    	return redirect('/office');
    }
}
