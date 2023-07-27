<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function viewUsers(){

        $users = User::all();
        $roles = Role::all();

        $auth = auth()->user();

        return view('admin.user.add')->with([
            'users' => $users,
            'auth' => $auth,
            'roles' => $roles
        ]);
    }

    public function toggleActivation(Request $request){
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        $user = User::where('id', $request->user_id)->first();

        $user->is_active = $user->is_active === 1 ? 0 : 1;
        $user->save();

        return back();
    }

    public function store(){}

    public function editUser($id){
        $user = User::find($id);
        if (!$user) {
            return back();
        }

        $auth = auth()->user();

        $roles = Role::with(['users'])->get();

        return view('admin.user.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'user_id' => 'required',
            'name' => 'required|string',
            'email' => 'required|string',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user_id = intval($request->user_id);
        $role_id = intval($request->role_id);

        $email_taken = User::where('id', '!=', $user_id)->where('email', $request->email)->first();

        if ($email_taken) {
            return back()->with('status', 'Email is already taken');
        }

        $user = User::where('id', $user_id)->first();
        if (!$user) {
            return back()->with('status', 'Unauthoized user');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $role_id
        ]);

        return redirect()->route('users.view');
    }

    public function destroy(){}
}
