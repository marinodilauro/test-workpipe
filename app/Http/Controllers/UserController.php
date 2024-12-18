<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        //dd($users);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // dd($request);

        // Validate
        $val_data = $request->validated();

        // Generate random password and hashing
        $randomPassword = Str::random(10);
        $val_data['password'] = bcrypt($randomPassword);

        // Create

        //dd($request->all());
        $user = User::create($val_data);

        // Redirect
        return to_route('users.index', $user)->with('message', "User $user->first_name $user->last_name created succesfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {


        // dd($user);

        // Validate
        $val_data = $request->validated();

        // dd($val_data);

        // Update user
        //dd($request->all());
        $user->update($val_data);

        // Redirect
        return to_route('users.index', $user)->with('message', "User $user->first_name $user->last_name updated succesfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete user
        $user->delete();

        // Redirect
        return to_route('users.index', $user)->with('message', "User $user->first_name $user->last_name deleted!");
    }
}
