<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\CommentReply;
use App\Photo;
use App\Category;
use App\User;

use Illuminate\Http\Request;
use App\Http\Requests\PostsCreateRequest;
use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::paginate(2);
        //$posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $user=Auth::user();

        $input = $request->all();

        if($file = $request->file('photo_id'))
        {
            $photo['file'] = time().$file->getClientOriginalName();
            $photo['size'] = $file->getsize();

            $file->move('images',$photo['file']);
            $getPhoto = Photo::create($photo);
            $input['photo_id'] = $getPhoto->id;
        }

        
        $user->posts()->create($input);
        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request->all();
        $user = Auth::user();

        $input = $request->all();

        if($file = $request->file('photo_id'))
        {
            $photo['file'] = time().$file->getClientOriginalName();
            $photo['size'] = $file->getsize();

            $file->move('images',$photo['file']);
            $getPhoto = Photo::create($photo);
            $input['photo_id'] = $getPhoto->id;
        }
        
        $user->posts()->whereId($id)->first()->update($input);
        Session::flash('msg','Post updated successfully');
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $post = Post::findOrFail($id);
        unlink(public_path().$post->photo->file);
        $post->delete();
        Session::flash('msg','Post deleted successfully');
        return redirect('/admin/posts');
    }

    
}
