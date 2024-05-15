<?php

namespace App\Security;

use Symfony\Component\Security\Http\Authenticator\JsonLoginAuthenticator;
use Symfony\Component\HttpFoundation\Request;

class CustomJsonLoginAuthenticator extends JsonLoginAuthenticator
{
    protected function getCredentials(Request $request)
    {
        $credentials = json_decode($request->getContent(), true);

        return [
            'username' => $credentials['email'], // On remplace 'email' par 'username' (pour gérer l'erreur lors de la connexion)
            'password' => $credentials['password'],
        ];
    }
}
