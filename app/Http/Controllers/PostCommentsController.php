<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Comment;
use App\Post;

use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
        $comments = Comment::all();
		return view('admin.comments.index',compact('comments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$user = Auth::user();
		$data = [
			'post_id' => $request->post_id,
			'author'  => $user->name,
			'email'   => $user->email,
			'body'    => $request->body,
            'photo' => $user->photo ? $user->photo : ''];

		Comment::create($data);

        Session::flash('msg','comment created');
        return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$comments=Comment::where('post_id',$id)->get();
        return view('admin.comments.show',compact('comments'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
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
		Comment::findOrFail($id)->update($request->all());
        return redirect('admin/comments');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		Comment::findOrFail($id)->delete();
        //return redirect('admin/comments');
        return redirect()->back();
	}
}
