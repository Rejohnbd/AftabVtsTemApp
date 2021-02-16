<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = User::select('id', 'type', 'email')
            ->where('type', 'super_admin')
            ->orWhere('type', 'expense_trip')
            ->orWhere('type', 'maintenance')
            ->orWhere('type', 'dashboard_report')
            ->get();
        return view('admin.pages.users.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $newUser = new User;
        $newUser->type = $request->type;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $saveUser = $newUser->save();

        if ($saveUser) {
            session()->flash('success', 'User Added Successfully');
            return redirect()->route('users.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('users.index');
        }
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
        $userInfo = User::findOrFail($id);
        return view('admin.pages.users.edit', compact('userInfo'));
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
        // dd($request->all(), $id);
        $user = new User;
        $userUpdate = $user->where('id', $id)
            ->update([
                'email'     => $request->email,
                'type'      => $request->type,
                'password'  => Hash::make($request->password)
            ]);

        if ($userUpdate) {
            session()->flash('success', 'User Info Update Successfully');
            return redirect()->route('users.index');
        } else {
            session()->flash('error', 'Something Happend Wrong');
            return redirect()->route('users.index');
        }
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

    public function destroyUser(Request $request)
    {
        if (User::where('id', $request->userId)->delete()) {
            return response(['result' => true]);
        }
    }
}
