<?php

namespace App\Http\Controllers;

use App\College;
use Illuminate\Http\Request;
use Response;

class CollegeController extends Controller
{

 public function __construct()
    {
        $this->middleware('auth');
    }

    
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

    	return Response::json($create);
    }

    public function edit(Request $request, $id)
    {
    	$edit = College::findOrFail($id);

    	return Response::json($edit);
    }

    public function update(Request $request, $id)
    {
    	$update = College::findOrFail($id);

    	$update->update($request->all());

    	return Response::json($update);
    }

    public function destroy($id)
    {
    	$delete = College::findOrFail($id);
    	$delete->delete();


    	return Response::json($delete);
    }
}
