<?php
Route::get('/tiketux/usermanagement/api/list', 'Tiketux\UserManagement\Api\UserManagementApi@list');
Route::post('/tiketux/usermanagement/api/generateToken', 'Tiketux\UserManagement\Api\UserManagementApi@generateToken');

