<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;
use Response;

class OfficeController extends Controller
{

 public function __construct()
    {
        $this->middleware('auth');
    }
    
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

    	return Response::json($create);
    }

    public function edit(Request $request, $id)
    {
    	$edit = Office::findOrFail($id);

    	return Response::json($edit);
    }

    public function update(Request $request, $id)
    {
    	$update = Office::findOrFail($id);

    	$update->update($request->all());

        return Response::json($update);
    }

    public function destroy($id)
    {
    	$delete = Office::findOrFail($id);
    	$delete->delete();

    	return Response::json($delete);
    }
}
