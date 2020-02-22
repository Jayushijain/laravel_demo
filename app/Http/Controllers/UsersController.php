<?php

namespace App\Http\Controllers;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;
use App\Http\Requests;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //in list() method the second parameter will be set to value parameter of select.
        //list() returns array.
        $roles = Role::lists('name','id')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //return $request->all();
        if(trim($request->password) =='')
        {
            $input = $request->except('password');
        }
        else
        {
            $input = $request->all();
            $input['password'] =bcrypt($request->password);
        }
        
        $photo =[];
        if($file = $request->file('photo_id'))
        {
            $photo['file'] = time().$file->getClientOriginalName();
            $photo['size'] = $file->getSize();

            $file->move('images',$photo['file']);
        }

        $getphoto = Photo::create($photo);

        $input['photo_id'] = $getphoto->id;
        
        //print_r($input);
         User::create($input);
         return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::lists('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if(trim($request->password) =='')
        {
            $input = $request->except('password');
        }
        else
        {
            $input = $request->all();
            $input['password'] =bcrypt($request->password);
        }
        
        $input = $request->all();
        $photo =[];
        if($file = $request->file('photo_id'))
        {
            $photo['file'] = time().$file->getClientOriginalName();
            $photo['size'] = $file->getSize();

            $file->move('images',$photo['file']);

            $getphoto = Photo::create($photo);
            $input['photo_id'] = $getphoto->id;
        }        

        
        $input['password'] =bcrypt($request->password);
        //print_r($input);
         $user->update($input);
         return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
