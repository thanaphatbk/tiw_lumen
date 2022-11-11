<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;

class UsersController extends Controller
{
    public function getAllUserbyController(){
        $data = DB::select("SELECT * FROM users");
        $result = [
            'From' => 'UsersController',
            'Data' => $data
        ];
        return response()->json($result);
    }

    public function getAllUserbyModels(){
        $data = Users::all();
        $result = [
            'From' => 'Models Users',
            'Data' => $data
        ];
        return response()->json($result, 200);
    }
    public function addNewUser(Request $request){
        $this->validate($request, [
            'name' => 'required|',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
        ];
        
        // $status_insert = DB::insert("INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES (NULL, ?, ?, ?, ?, ?); ", [$name, $email, $password, date("Y-m-d H:i:s"), date("Y-m-d H:i:s")]);
        date_default_timezone_set('Asia/Bangkok');
        $status_insert = Users::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'created_at' => date("Y-m-d H:i:s"), 
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        $result = [
            'Status' => 'success',
            'Status code' => '200',
            'Add data' => $data,
            'statsus_insert' => $status_insert,
        ];
        return response()->json($result, 200);
    }

    public function update_name($id, Request $request){
        
        $user = Users::findOrFail($id);
        $user->update($request->all());
        // $status_insert = Users::where('id', $id)->update(['name' => $request->name]);
        
        $result = [
            'Status' => 'update name success',
            'Status code' => '200',
            'New name' => $request->name,
            'User' => $user,
        ];
        return response()->json($result, 200);
    }

    public function delete_by_id($id){
        
        $user = Users::findOrFail($id);
        $user->delete();        
        $result = [
            'Status' => 'Delete id ' . $id .' success',
            'Status code' => '200',
        ];
        return response()->json($result, 200);
    }

   
}
