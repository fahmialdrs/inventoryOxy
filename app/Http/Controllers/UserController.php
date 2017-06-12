<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
use App\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->orderBy('created_at', 'desc')->get();
        return view('user.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $password = $request->input('password');
        $data['password'] = bcrypt($password);

        $users = User::create($data);

        // set role
        $role = $request->input('role');
        
        $assignRole = Role::where('name', $role)->first();
        $users->attachRole($assignRole);

        

        // kirim email
        // Mail::send('auth.email.invite', compact('member', 'password'), function ($m) use ($member) {
        //     $m->to($member->email, $member->name)->subject('You already registered in Online Library');
        // });

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Pendaftaran Pengguna Dengan Nama " . "<strong>" . $data['email'] ."</strong>" . " Password <strong>" . $password . "</strong> Berhasil Di Daftarkan" 
            ]);
        return redirect()->route('user.index');
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
        $users = User::find($id);
        return view('user.edit')->with(compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $users = User::find($id);
        $users->update($request->all());
        $password = $request->input('password');

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Perubahan Pengguna Dengan Nama " . "<strong>" . $users->email ."</strong>" . " Password <strong>" . $password . "</strong> Berhasil Di Ubah" 
            ]);

        return redirect()->route('user.index');
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
