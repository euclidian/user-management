<?php

namespace Tiketux\UserManagement;

use Illuminate\Support\ServiceProvider;

class UserManagementServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    $this->loadRoutesFrom(__DIR__.'/routes.php');
    $this->publishes([
        __DIR__.'/migrations' => database_path('migrations'),
    ],"Migration_UserManagement");
    $this->publishes([
        __DIR__.'/components' => resource_path('js/components'),
    ],"Component_UserManagement");
  }

  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
  }
}
