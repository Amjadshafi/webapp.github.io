<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('users.index')->with('users', $users);
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_no' => 'required|string|max:20',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Create a new instance of the User model with validated data
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Hash the password for security
        ]);

        // Save the user to the database
        $result = $user->save();
        $user->assignRole($request['role_name']);

        // Check if the user was successfully saved
        if ($result) {
            return redirect()->route('usersList')->withSuccess('User has been added');
        } else {
            return redirect()->back()->withError('Failed to add user');
        }
    }

    public function create()
    {
        $roleObj = new Role();
        $roles = $roleObj->get();
        return view('users.create', compact('roles'));
    }
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }
    public function edit(User $user)
    {
        $roleObj = new Role();
        $roles = $roleObj->get(); 
        return view('users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }
    public function update(Request $request, User $user)
    {
        $old_role_name = (!empty($user->roles[0]['name']) ? $user->roles[0]['name'] : 0);
        if($old_role_name > 0){
            $user->removeRole($old_role_name);
        }
        $user->assignRole($request['role_name']);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('usersList')
            ->with('success', 'User updated successfully');
    }
    // public function destroy($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->delete();
    //     return redirect()->route('user.index')->withSuccess('User successfully deleted.');
    // }
}
