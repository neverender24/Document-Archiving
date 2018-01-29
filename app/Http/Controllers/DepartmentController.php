<?php

namespace App\Http\Controllers;

use App\College;
use App\Department;
use Illuminate\Http\Request;
use Response;

class DepartmentController extends Controller
{

 public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $colleges = College::pluck('description','id')->toArray();

    	$data = Department::with('college')->get();

    	return view('admin.department.index', compact('data','colleges'));
    }

    public function create()
    {
    	$colleges = College::pluck('description','id')->toArray();

    	return view('admin.department.create', compact('colleges'));
    }

    public function store(Request $request)
    {
    	$create = Department::create($request->all());

    	
    	return Response::json($create);
    }

    public function edit(Request $request, $id)
    {
    	$colleges = College::pluck('description','id')->toArray();

    	$edit = Department::findOrFail($id);

    	return Response::json($edit);
    }

    public function update(Request $request, $id)
    {
    	$update = Department::findOrFail($id);

    	$update->update($request->all());


    	return Response::json($update);
    }

    public function destroy($id)
    {
    	$delete = Department::findOrFail($id);
    	$delete->delete();


    	return Response::json($delete);
    }
}
