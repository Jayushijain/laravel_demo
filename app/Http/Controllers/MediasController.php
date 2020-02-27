<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Photo;

use App\Http\Requests;

class MediasController extends Controller
{
    public function index()
    {
        $photos =Photo::all();
        return view('admin.medias.index',compact('photos'));
    }

    public function create()
    {

        //in list() method the second parameter will be set to value parameter of select.
        //list() returns array.
        //$roles = Role::lists('name','id')->all();
        return view('admin.medias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();        
        if($file = $request->file('file'))
        {
            $photo['file'] = time().$file->getClientOriginalName();
            $photo['size'] = $file->getSize();

            $file->move('images',$photo['file']);
            Photo::create($photo);
        }

         return redirect('/admin/medias');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        //this method will delte photo from public/image folder.
        unlink(public_path().$photo->file);
        $photo->delete();

        Session::flash('msg','Photo has been deleted successfully');
        return redirect('/admin/medias');
    }

     public function deleteMedia(Request $request)
     {
        //return $request->checkarray;
        
        if(!empty($request->checkarray))
        {
            $photos = Photo::findOrFail($request->checkarray);

            foreach ($photos as $photo) 
            {
                $photo->delete();
                
            }

            Session::flash('msg','Photos has been deleted successfully');
             return redirect()->back();
            
        }
        else
        {
            
             Session::flash('msg','Please select items to delete');
              return redirect()->back();
        }
       
        
        //return "works";

     }
}
