<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
    	$postsCount = Post::count();
    	$CategoriesCount = Category::count();
    	$CommentsCount = Comment::count();

    	return view('admin.index',compact('postsCount','CategoriesCount','CommentsCount'));
    }
}
