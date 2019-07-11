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
    ],"Migration_Alter_Tabel_User");
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
