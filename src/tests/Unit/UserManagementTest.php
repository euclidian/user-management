<?php

namespace Tiketux\UserManagement\Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;

class UserManagementTest extends PassportTestCase
{
  use DatabaseTransactions;
  use WithFaker;

  public $baseUrl   = 'http://127.0.0.1';

  public function testGenerateToken()
  {
    $response = $this->post("/tiketux/usermanagement/api/generateToken", [
      "user_id" => $this->user->id
    ]);

    $response->assertStatus(200)
      ->assertJson([
        "statusCode" => 200,
        "data" => [
          "user_id" => $this->user->id
        ]
      ]);
    $this->assertDatabaseHas("oauth_clients", [
      "user_id" => $this->user->id
    ]);
  }

  public function testGenerateTokenTidakBerhak()
  {
    $user = \Tiketux\UserManagement\Models\UserManagement::findOrFail($this->user->id);
    $user->is_admin = 0;
    $user->save();

    $response = $this->post("/tiketux/usermanagement/api/generateToken", [
      "user_id" => $this->user->id
    ]);

    $response->assertStatus(403);
  }

  public function testGenerateTokenUserTidakAda()
  {
    $response = $this->post("/tiketux/usermanagement/api/generateToken", [
      "user_id" => $this->user->id + 1
    ]);

    $response->assertStatus(404);
  }
}
