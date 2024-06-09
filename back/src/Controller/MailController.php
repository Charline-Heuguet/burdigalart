<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/messages', name: 'message_')]
class MailController extends AbstractController
{
    #[Route('/', name: 'send', methods: ['POST'])]
    public function sendMessage(Request $request, MailerInterface $mailer): Response
    {
        $data = json_decode($request->getContent(), true);

        // log pour voir les données reçues
        error_log(print_r($data, true));

        $targetInfo = $data['targetInfo'] ?? 'Informations du destinataire non spécifiées';

        $email = (new Email())
            // Configuration de l'email
            ->from($data['email'])
            ->to('burdigalart@mailtrap.io')
            ->subject('Nouveau message de ' . ($data['firstname'] ?? 'un visiteur') . " - " . $targetInfo)
            ->text("Rôle: " . ($data['role'] ?? 'Non spécifié') . "\n" .
                "Message: " . ($data['message'] ?? 'Pas de contenu') . "\n" .
                "Destiné à: " . $targetInfo)
            ->html('<p>Rôle: ' . ($data['role'] ?? 'Non spécifié') . '</p>' .
                '<p>Message: ' . ($data['message'] ?? 'Pas de contenu') . '</p>' .
                '<p>Destiné à: ' . $targetInfo . '</p>');

        $mailer->send($email);

        return new Response('Email envoyé avec succès! Données: ' . print_r($data, true));
    }
}
