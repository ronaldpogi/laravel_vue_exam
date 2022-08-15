<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::all()->sortBy('created_at');

        

        $roleData = User::find(Auth::User()->id)->getRole;

        $returnData = array();

        if($roleData->role_name == 'Admin'){
            $getOnlyUserRole = Role::where('role_name', 'User')->get('user_id');

            // $returnData = User::select('*')
            // ->whereIn('id', $getOnlyUserRole)
            // ->get();

            $returnData = User::where('id', Auth::User()->id)
                    ->orWhereIn('id', $getOnlyUserRole)
                    ->get();

        } else {
            $returnData = User::where('id', Auth::User()->id)->get();
        }

        return [
            'user_data' => $returnData, 
            'role_data' => $roleData
        ];
    }

    public function getRole($id){
        $role = User::find($id)->getRole;

        return $role;
    }

    public function updateRole(Request $request, $id){
        $fields = $request->validate([
            'role_name' => 'required',
            'description' => 'required'
        ]);

        $resp = Role::where('user_id', $id)->first()->update($fields);

        return $resp;
    }

    public function getInfo($id){
        $info = User::find($id);
        return $info;
    }

    public function updateInfo(Request $request, $id){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|string|confirmed|min:8',
        ]);

        $fields['password'] = bcrypt($fields['password']);

        $resp = User::where('id', $id)->first()->update($fields);

        return $resp;
    }

    public function createUser(Request $request){ 

        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'role_name' => 'required'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $role = Role::create([
            'user_id' => $user->id,
            'role_name' => $fields['role_name'],
            'description' => $request->description
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }

    public function loginUser(Request $request){
        
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid Username or Password'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }

    public function logout(Request $request) {

        auth()->user()->tokens()->delete();

        // $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function destroyUser($id){

        $destroyUser = User::where('id', $id)->delete();
        $destroyRole = Role::where('user_id', $id)->delete();

        $check = User::where('id', Auth::User()->id)->first();

        return $check;
    }
}
