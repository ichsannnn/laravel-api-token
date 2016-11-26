<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function postLogin(Request $r)
    {
      $username = $r->input('username');
      $password = $r->input('password');
      $response = [];

      if (Auth::attempt(['username' => $username, 'password' => $password])) {
        $response['success'] = 1;
        $response['message'] = 'Login berhasil!';
        // Auth::check();
        // $response['id'] = Auth::user()->id;
        $user = User::find(Auth::user()->id);
        $user->api_token = str_random(60);
        $user->save();
        $response['user'] = $user;

        return response()->json($response);
      }
    }

    public function postRegister(Request $r)
    {
      $user = new User;
      $response = [];

      $user->name = $r->input('name');
      $user->username = $r->input('username');
      $user->password = bcrypt($r->input('password'));
      $user->api_token = str_random(60);
      $user->save();

      $response['success'] = 1;
      $response['message'] = 'Registrasi sukses!';

      return response()->json($response);
    }

    public function getLogout()
    {
      Auth::logout();
      $response = [];

      $response['success'] = 1;

      return response()->json($response);
    }
}
