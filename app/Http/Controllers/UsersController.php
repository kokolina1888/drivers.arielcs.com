<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ User;
use Illuminate\Support\Facades\Validator;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.users_list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.users_create');
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
        $this->validator($request->all())->validate();

        User::create([
            'username' => $request['username'],            
            'password' => bcrypt($request['password']),
        ]);

        Session::flash('success', 'Създадохте нов потребител!');
        return redirect()->route('users_list');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.unique'   => 'Вече се използва! Изберете друго!',
            'username.required' => 'Попълнете!',
            'password.required' => 'Попълнете!',
            'password.min'      => 'Най-малко 6 знака!',
            'password.confirmed' => 'Въведените пароли не съвпадат!',
        ]);
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

        return view('users.users_edit', compact('user'));
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
        $this->update_validator($request->all(), $id)->validate();

        $user = User::findOrFail($id);

        $user->username = $request['username'];
        $user->password = bcrypt($request['password']);

        $user->save();

        Session::flash('success', 'Създадохте нов потребител!');
        return redirect()->route('users_list');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function update_validator(array $data, $id)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users,username,'. $id,
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.unique'   => 'Вече се използва! Изберете друго!',
            'username.required' => 'Попълнете!',
            'password.required' => 'Попълнете!',
            'password.min'      => 'Най-малко 6 знака!',
            'password.confirmed' => 'Въведените пароли не съвпадат!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        Session::flash('success', "Изтрихте потребител!");

        return redirect()->route('users_list');
    }
}
