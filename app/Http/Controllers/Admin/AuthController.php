<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'bail|required|email',
            'password' => 'bail|required',
        ]);

        $user = User::where("email", $request->email)->where('role_id', 1)->first();

        if (!$user) {
            return back()->with('status', 'Unauthoized user');
        }

        if ($user->is_active !== 1) {
            return back()->with('status', 'Your account has been deactivated');
        }

        if(!auth()->attempt($request->only('email', 'password'))){
            return back()->with('status', 'Invalid login details');
        }

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('admin.dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');

    }
}
