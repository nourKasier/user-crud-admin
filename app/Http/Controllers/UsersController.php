<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        // $this->authorize('isAdmin', User::class);
        return $dataTable->render('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $validatedData = $request->validated();
        $hashedPassword = Hash::make($validatedData['password']);
        $path = 'avatars/images';
        $original_image_name = $validatedData['avatar']->getClientOriginalName();
        $new_image_name = uniqid() . $original_image_name;
        $request->file('avatar')->move(public_path($path), $new_image_name);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'email_verified_at' => $validatedData['email_verified_at'],
            'password' => $hashedPassword,
            'avatar' => $new_image_name,
            'phone_number' => $validatedData['phone_number'],
            'subscription_end_date' => $validatedData['subscription_end_date'],
            'is_admin' => isset($validatedData['is_admin']) ? true : false,
        ]);

        return redirect()->back()->withInput()->with('success', 'User created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest  $request, string $id)
    {
        $validatedData = $request->validated();
        $user = User::findOrFail($id);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->email_verified_at = $validatedData['email_verified_at'];
        $user->phone_number = $validatedData['phone_number'];
        $user->subscription_end_date = $validatedData['subscription_end_date'];

        if (!empty($validatedData['password'])) {
            $hashedPassword = Hash::make($validatedData['password']);
            $user->password = $hashedPassword;
        }

        if ($request->hasFile('avatar')) {
            $path = 'avatars/images';
            $original_image_name = $validatedData['avatar']->getClientOriginalName();
            $new_image_name = uniqid() . $original_image_name;
            $request->file('avatar')->move(public_path($path), $new_image_name);
            $user->avatar = $new_image_name;
        }

        $user->is_admin = isset($validatedData['is_admin']) ? true : false;
        $user->save();
        return redirect()->back()->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return response()->json(['success' => true, 'message' => 'User deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to delete user'], 500);
        }
    }
}
