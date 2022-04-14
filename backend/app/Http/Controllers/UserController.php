<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'bail|required|string|min:6|max:32',
            'password' => 'bail|required|string|min:6|max:32',
        ]);
        if ($validator->fails()) {
            return array(0,$validator->errors());
        }
        if (Auth::attempt(['username'=>$request, 'password'=>$request->password]))
        {
            $token = Auth::user()->createToken('userToken')->plainTextToken;
            return array(1,$token);
        }else{
            return array(0,$validator->getMessageBag()->add('bad credentials', 'the credentials do not match our records.'));
        }
    }
    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:6|max:32',
            'username' => 'required|string|unique:users,username|min:6|max:32',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|max:32'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $user = UserController::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email
        ]);
        $token = $user->createToken('my-app-token')->plainTextToken;
        return response(['user' => $user, 'token' => $token], 201);
    }
    function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'currentPassword' => 'bail|present|required|string|min:6|max:32|current_password',
            'newPassword' => 'required|string|min:6|max:32',
            'newConfirmPassword' => 'required|same:newPassword|min:6|max:32'
        ]);
        if ($validator->fails()) {
            return array(0,$validator->errors());
        }

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->newPassword)]);
        return array(1);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return array(1);
    }
}
