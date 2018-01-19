<?php

namespace App\Http\Controllers;

use App\Category;
use App\Document;
use App\Drawer;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $search = \Request::get('search');

    	$data = Document::with('drawer')->with('user');

        if(!is_null($search)){
            $data->where('subject','like','%'.$search.'%');
        }

        if(!is_null(\Request::get('drawer_id'))){
            $data->orWhere('drawer_id', \Request::get('drawer_id'));
        }
        
        $data = $data->get();
        

    	return view('admin.document.index', compact('data'));
    }

    public function create()
    {
    	$categories = Category::pluck('description','id')->toArray();
        
    	$drawers = Drawer::pluck('description','id');

        if(is_null(\Auth::user()->office_id)){
            $drawers->where('office_id', \Auth::user()->office_id);
        }

        if(is_null(\Auth::user()->department_id)){
            $drawers->where('department_id', \Auth::user()->department_id);
        }

        $drawers = $drawers->toArray();

    	//return view('admin.document.create', compact('drawers', 'categories'));
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

    	$edit = Document::findOrFail($id);

        $drawers = Drawer::pluck('description','id');

        if(is_null(\Auth::user()->office_id)){
            $drawers->where('office_id', \Auth::user()->office_id);
        }

        if(is_null(\Auth::user()->department_id)){
            $drawers->where('department_id', \Auth::user()->department_id);
        }

        $drawers = $drawers->toArray();

    	return view('admin.document.edit', compact('edit','drawers','categories'));
    }

    public function update(Request $request, $id)
    {
        if(is_null($request['is_private'])){
            $request['is_private'] = 0;
        }else{
            $request['is_private'] = 1;
        }

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
