<?php

namespace App\Http\Controllers;

use App\Document;
use App\Inbox;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InboxController extends Controller
{

 public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $search = \Request::get('search');

    	$data = Inbox::
    	leftjoin('documents','documents.id','=','inboxes.document_id')
    	->leftjoin('users','users.id','=','inboxes.sender_id')
    	->where('receiver_id',\Auth::user()->id)
        ->where('subject','like','%'.$search.'%')
    	->select('inboxes.id','users.name','documents.content','documents.subject','received_at', 'document_id','inboxes.created_at')
    	->get();

    	//dd($data);

    	return view('admin.document.inbox', compact('data'));
    }

    public function sending(Request $request, $document_id)
    {
    	$users = User::pluck('name','id')->toArray();

    	return view('admin.document.sending', compact('users', 'document_id'));
    }

    public function sent(Request $request, $document_id)
    {
        \Session::flash('success','Document sent');

    	foreach($request['docs'] as $id) 
    	{
    		$inbox = new Inbox();
    		$inbox->sender_id = \Auth::user()->id;
    		$inbox->document_id = $document_id;
    		$inbox->receiver_id = $id;
    		$inbox->save();
    	}

    	return redirect('document/'.$document_id.'/sending');
    }

    public function receive(Request $request, $document_id, $id)
    {
    	$r = Inbox::find($id);
    	$r->received_at = Carbon::now();
    	$r->save();

    	return redirect('inbox');
    }

    public function log($document_id)
    {
    	$data = Inbox::
    	leftjoin('documents','documents.id','=','inboxes.document_id')
    	->leftjoin('users','users.id','=','inboxes.receiver_id')
    	->where('sender_id',\Auth::user()->id)
    	->where('document_id',$document_id)
    	->select('inboxes.id','users.name','documents.content','documents.subject','received_at', 'document_id','inboxes.created_at')
    	->get();

    	return view('admin.document.log', compact('data'));
    }

    public function destroy($id)
    {
        $delete = Inbox::findOrFail($id);
        $delete->delete();

        \Session::flash('success','Document Deleted');

        return redirect('/inbox');
    }
}
