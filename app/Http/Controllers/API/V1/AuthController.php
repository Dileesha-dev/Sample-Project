<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

/**
 * @group Authentication
 *
 * API endpoints for managing authentication
 */

class AuthController extends Controller
{
    /**
     * Register the user.
     *
     * @bodyParam   name    string  required    The full name of the  user.      Example: Mike Tyson
     * @bodyParam   email    string  required    The email of the  user.      Example: testuser@example.com
     * @bodyParam   password    string  required    The password of the  user.   Example: secret
     * @bodyParam   password_confirmation    string  required    The password confirmation of the  user.   Example: secret
     *
     * @response {
     * 
     *  "user": {
     *      "id": 2,
     *      "name": "Jack Sparrow",
     *      "email": "jack@sparrow.ship",
     *      "email_verified_at": null,
     *      "is_admin": 0,
     *       "created_at": "2022-05-16T05:12:01.000000Z",
     *       "updated_at": "2022-05-16T05:12:01.000000Z"
     * },
     *  "token": "4|UuwRyt2CMfNkxdr44Y1wuORDzz70HhuFvblR67uC",
     * }
     */
    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken('apptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    /**
     * Log in the user.
     *
     * @bodyParam   email    string  required    The email of the  user.      Example: testuser@example.com
     * @bodyParam   password    string  required    The password of the  user.   Example: secret
     *
     * @response {
     * 
     *  "user": {
     *      "id": 2,
     *      "name": "Jack Sparrow",
     *      "email": "jack@sparrow.ship",
     *      "email_verified_at": null,
     *      "is_admin": 0,
     *       "created_at": "2022-05-16T05:12:01.000000Z",
     *       "updated_at": "2022-05-16T05:12:01.000000Z"
     * },
     *  "token": "4|UuwRyt2CMfNkxdr44Y1wuORDzz70HhuFvblR67uC",
     * }
     */
    
    public function login(Request $request){
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //Check email
        $user = User::where('email', $data['email'])->first();

        // Check password
        if(!$user || !Hash::check($data['password'], $user->password)){
            return response(['message' => 'Authentication failed!'], 401);
        }

        $token = $user->createToken('apptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Logout the user.
     *
     * @response {
     * 
     *  "message": "Logged Out"
     * }
     */
    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out'
        ];
    }
    
    /**
     * Profile of the user.
     *
     * @response {
     * 
     *  "payload": {
     *      "id": 2,
     *      "name": "Jack Sparrow",
     *      "email": "jack@sparrow.ship",
     *      "email_verified_at": null,
     *      "is_admin": 0,
     *       "created_at": "2022-05-16T05:12:01.000000Z",
     *       "updated_at": "2022-05-16T05:12:01.000000Z"
     *      },
     *      "message": "Profile info"
     * }
     */
    public function profile(){
        return response([
            'payload' => auth()->user(),
            'message' => 'Profile info'
        ]);
    }
}
