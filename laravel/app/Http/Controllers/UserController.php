<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Helpers\Data;
use App\User;
use Image;
use File;
use Alert;
use Carbon\Carbon;

class UserController extends Controller
{
    public $path;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('roles');
        $this->path = 'images/photo';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // var_dump($this->path);die();
        $user = Data::getInstance()->getData('App\User', 'name', 'asc');
        $role = Data::getInstance()->getData('App\Role', 'id', 'asc');

        return view('admin.contents.user.content', get_defined_vars());
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
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg',
            'role' => 'required'
        ]);

        if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path);
        }

        if ($request->image == NULL) {
            $user = new User([
                'name' => $request->get('name'),
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'role' => $request->get('role')
            ]);
        } else {
            $image = $request->file('image');
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save($this->path . '/' . $fileName);

            $user = new User([
                'name' => $request->get('name'),
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'image' => $fileName,
                'role' => $request->get('role')
            ]);
        }        

        $user->save();

        if ($user->save()) {
            Alert::success('User has been added.', 'Success');
        }

        return redirect('/admin/user');
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
        $data = User::find($id);
        $role = Data::getInstance()->getData('App\Role', 'id', 'asc');        
        $image = $this->path.$data->image;

        return view('admin.contents.user.edit', get_defined_vars());
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
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'image' => 'image|mimes:jpg,png,jpeg',
            'role' => 'required'
        ]);

        if (!File::isDirectory($this->path)) {
            File::makeDirectory($this->path);
        }

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->role = $request->get('role');

        if ($request->image != NULL) {
            $image = $request->file('image');
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save($this->path . '/' . $fileName);            
            $user->image = $fileName;
        }

        $user->save();

        if ($user->save()) {
            Alert::success('User has been updated.', 'Success');
        }

        return redirect('/admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/admin/user')->with('success', 'User has been deleted.');
    }
}
