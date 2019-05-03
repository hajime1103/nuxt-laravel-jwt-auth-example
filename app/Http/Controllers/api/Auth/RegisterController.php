<?php

namespace App\Http\Controllers\api\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Tymon\JWTAuth\JWTAuth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    | このコントローラは新規ユーザの登録とそのユーザの登録を処理します。
    | 検証と作成 デフォルトでは、このコントローラーは以下の特性を使います。
    | 追加のコードを必要とせずにこの機能を提供します。

    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '';

    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 登録関数をオーバライドする
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        if(!$validator->fails()){

            //$user = $this->create($request->all());
            event(new Registered($user = $this->create($request->all())));

            $token = $this->auth->attempt($request->only(`email`, 'password'));

            return response()->json([
                'success' => true,
                'data' => $user,
                'token' => $token
            ], 200);
        }

        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
