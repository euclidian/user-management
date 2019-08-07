<?php

namespace Tiketux\UserManagement\Base;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as LaravelController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser;

class BaseController extends LaravelController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static function getCurrentClient($request)
    {
        $clientRepository = new ClientRepository();
        $jwt = (new Parser())->parse($request->bearerToken());
        $client = $clientRepository->find($jwt->getClaim('aud'));
        return $client;
    }
    public static function getCurrentToken($request)
    {
        $tokenRepository = new TokenRepository();
        $jwt = (new Parser())->parse($request->bearerToken());
        $token = $tokenRepository->find($jwt->getClaim('jti'));
        return $token;
    }
}
