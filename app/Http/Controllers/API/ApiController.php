<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function getUsers()
    {
        $users = User::get();
        return response()->json(['data' => $users]);
    }

    public function editUser($id){
        $user = user::findOrFail($id);
        return response()->json(['status' => 'success', 'message' => 'request Update Success', 'data' => $user]);


    }


    public function storeUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }


            $users = user::create($request->all());
            return response()->json(['data' => $users, 'message' => 'Request Succes'], 201);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'request failed', 'errors' => $th->getMessage()], 500);
        }
    }

    public function updateUser(Request $request, $id){
        try {
            $user = user::findOrFile($id);
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',

            ]);
            if($validator->fails()){
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }
            $user->name = $request->name;
            $user->email = $request->email;

            if($request->filled('password')){
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return response()->json(['status' => 'success', 'message' => 'request Update Success', 'data' => $user]);


        } catch (\Throwable $th) {
            return response()->json(['status' => 'success', 'message' => 'request Field', 'error' => $th->getMessage()], 500);
        }
    }

}
