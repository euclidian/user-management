<?php

namespace Tiketux\UserManagement;

use Illuminate\Support\ServiceProvider;
use Tiketux\UserManagement\Middlewares\IsAdmin;

class UserManagementServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    app()->make('router')->aliasMiddleware('admin', IsAdmin::class);
    $this->loadRoutesFrom(__DIR__ . '/routes.php');
    $this->publishes([
      __DIR__ . '/migrations' => database_path('migrations'),
    ], "Migration_UserManagement");
    $this->publishes([
      __DIR__ . '/components' => resource_path('js/components'),
    ], "Component_UserManagement");
    $this->publishes([
      __DIR__ . '/factories' => database_path('factories'),
    ], "Factory_UserManagement");
  }

  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  { }
}
