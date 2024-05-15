<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use App\Entity\User; // Assure-toi que User est utilisé

class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $user = $event->getUser();
        if (!$user instanceof User) {
            return; // S'assurer que $user est bien une instance de User
        }

        $payload = $event->getData();
        $payload['user_id'] = $user->getId(); // Utiliser getId() pour obtenir l'id
        $event->setData($payload); // Mettre à jour le payload du JWT
    }
}
