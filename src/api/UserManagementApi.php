<?php

namespace Tiketux\UserManagement\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\ClientRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tiketux\UserManagement\Models\UserManagement;
use Tiketux\UserManagement\Middlewares\IsAdmin;

class UserManagementApi extends Controller
{


  public function __construct()
  {
    $this->middleware(['auth:api', IsAdmin::class]);
  }

  public function list()
  {

    $allUser = UserManagement::select("users.id", "users.name", "users.email", "users.is_admin", "users.created_at", "oauth_clients.id as secretid", "oauth_clients.secret")
      ->orderBy("name")
      ->leftJoin('oauth_clients', 'users.id', '=', 'oauth_clients.user_id')
      ->get();

    $response["statusCode"] = 200;
    $response["data"] = $allUser;
    return response()->json($response);
  }

  public function generateToken(Request $request)
  {
    $request->validate(["user_id" => "required"]);
    $id = $request->input('user_id');

    DB::table("oauth_clients")->where("password_client", 0)->where("user_id", $id)->delete();
    $user = UserManagement::findOrFail($id);

    $CR = new ClientRepository;
    $CR->create($id, $user->name, "localhost");

    $oc = DB::table("oauth_clients")->where("password_client", 0)->where("user_id", $id)->first();
    $response["statusCode"] = 200;
    $response["data"] = $oc;
    return response()->json($response);
  }
}
