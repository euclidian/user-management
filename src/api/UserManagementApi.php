<?php

namespace Tiketux\UserManagement\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementApi extends Controller
{
  

  public function __construct()
  {
  	$this->middleware('auth:api');
  }

  public function list()
  {
  	// $user = new User();
   //  $allUser = $user->list();

        // $response = new BaseResponse();
        // $response->statusCode = 200;
        // $response->data = [
        //     'crud' => $canCrud,
        //     'user'  => $allUser,
        //     'user_level' => Auth::user()->user_level
        // ];
  	$response = "saya";
  	
    return response()->json($response);
  }



}