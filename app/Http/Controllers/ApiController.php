<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class ApiController extends Controller
{
    //

    public function register(Request $request) {
        $validator = Validator::make($request->all,
        [
            'name'  => 'required',
            'email' =>  'required|email',
            'password'  =>  'required',
            'c_password' => 'required|same:password'
        ]
        );
        if($validator->fails()) {
            return response()->json(['message'  => 'Validation Error'],400);
        }
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $response['token']  = $user->createToken('Passport');
        $response['name'] = $user->name;
        return $response->json($response,200);
    }
    public function login() {

    }
    public function detail() {

    }
}
