<?php

namespace Tiketux\UserManagement\Middlewares;

use Closure;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Tiketux\UserManagement\Models\UserManagement;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$userData = Auth::user()) {
            $client = Controller::getCurrentClient($request);
            $userId = $client->user_id;
            $userData = UserManagement::findOrFail($userId);
        }
        if ($userData &&  $userData->is_admin == 1) {
            return $next($request);
        }
        abort(403);
    }
}
