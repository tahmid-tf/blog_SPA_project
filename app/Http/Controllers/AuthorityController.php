<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorityController extends Controller
{
    public function viewAllAdmin(){
        $user = User::all();
        $logged_in = Auth::user();
        return response()->json([
            "users" => $user,
            "admin" => $logged_in
        ]);
    }

    public function deleteAdmin($id){
        $user = User::find($id);
        $user->delete();
        return response()->json([
            "message" => "Successfully delated"
        ]);
    }

    public function loggedInAccountDelete(){
        $user = Auth::user();
        $user->delete();
        return response()->json([
            'message' => "Successfully deleted"
        ]);
    }

    public function changePassword(Request $request){
        $pass = auth()->user()->password;

        $current_password = request('current_password');
        $new_password = request('new_password');
        $confirm_password = request('verify_password');

        if(\Illuminate\Support\Facades\Hash::check($current_password,$pass) && $new_password === $confirm_password){
            auth()->user()->update([
                'password' => bcrypt($new_password)
            ]);
            return response()->json([
                "message" => "Check Successfull"
            ]);
        }
    }
}
