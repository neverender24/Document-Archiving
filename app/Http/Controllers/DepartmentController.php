<?php

namespace App\Http\Controllers;

use App\College;
use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

 public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$data = Department::with('college')->get();

    	return view('admin.department.index', compact('data'));
    }

    public function create()
    {
    	$colleges = College::pluck('description','id')->toArray();

    	return view('admin.department.create', compact('colleges'));
    }

    public function store(Request $request)
    {
    	$create = Department::create($request->all());

    	\Session::flash('success','Department Added');

    	return redirect('/department');
    }

    public function edit(Request $request, $id)
    {
    	$colleges = College::pluck('description','id')->toArray();

    	$edit = Department::findOrFail($id);

    	return view('admin.department.edit', compact('edit','colleges'));
    }

    public function update(Request $request, $id)
    {
    	$update = Department::findOrFail($id);

    	$update->update($request->all());

    	\Session::flash('success','Department Updated');

    	return redirect('/department');
    }

    public function destroy($id)
    {
    	$delete = Department::findOrFail($id);
    	$delete->delete();

    	\Session::flash('success','Department Deleted');

    	return redirect('/department');
    }
}
