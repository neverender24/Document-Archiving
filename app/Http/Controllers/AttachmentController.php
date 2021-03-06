<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Document;
use Illuminate\Http\Request;
use Storage;

class AttachmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($document_id)
    {

    	$data = Attachment::where('document_id', $document_id)->get();
        $user = Document::where('id', $document_id)->first();
        $user = $user->user_id;

    	return view('admin.attachment.index', compact('data', 'document_id', 'user'));
    }

    public function create($document_id)
    {
    	return view('admin.attachment.create', compact('document_id'));
    }

    public function store(Request $request, $document_id)
    {
    	
    	 // check if files exist
    	 if ($request->hasFile('name'))
    	 {
    		$files = $request->file('name'); //get the files
    	 	// initialize the storage found in "config/filesystems"
	    	 $contents = Storage::disk('public');
	    	 
	    	// We will generate new random file name or you can create your own filename
	    	// You might consider duplicate image names
	    	foreach ($files as $file) 
	    	{
		    	 // random generated characters by FileUpload, 9 characters
		    	 //$new_name = $file->getFilename();
                  $new_name = $file->getClientOriginalName();
		    	 // get file extenstion
		    	// $extension = $file->extension();
		    	 
		    	 //$filename = $new_name.".".$extension;
		    	 $filename = $new_name;
		    	 // check then replace if filename exists. Only the 9 character name.
		    	 while( $contents->exists($filename) )
		    	 {
		    	 $rand = rand(000000000,999999999);
		    	 $filename = $rand.".".$extension;
		    	 }
		    	 //upload image in the disk storage base in your filesystems config probably public/images/quizzes
		    	 $contents->put(
		    	 $document_id."/".$filename,
		    	 file_get_contents($file->getRealPath())
		    	 );

		    	 $attachment = new Attachment;
		    	 $attachment->name = $filename;
		    	 $attachment->document_id = $document_id;
		    	 $attachment->save();


	    	}
    	}

    	return redirect('/document/'.$document_id.'/attachment');
    }

    public function destroy( $document_id, $id )
    {
    	$delete = Attachment::findOrFail($id);
    	$delete->delete();

    	return redirect('/document/'.$document_id.'/attachment');
    }

    public function download($document_id,$attachment_id)
    {
        $attachment = Attachment::findOrFail($attachment_id);

        $file = storage_path() .'/app/public/'.$attachment->document_id.'/'.$attachment->name;
        //$file = storage_path() .'/app/public/'.\Auth::user()->id.'/'.$attachment->name;

        //return($file);

        return response()->download($file, $attachment->filename);
    }


     public function viewers($document_id,$attachment_id)
    {
    $attachment = Attachment::findOrFail($attachment_id);

        $file = storage_path() .'/app/public/'.$attachment->document_id.'/'.$attachment->name;

    return response()->file($file);

//return response()->file($file, $headers);

        
    }
  



}
