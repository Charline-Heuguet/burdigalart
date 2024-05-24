<?php

// src/Controller/MessageController.php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Scene;
use App\Entity\Artist;
use App\Entity\Message;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;


class MessageController extends AbstractController
{

    // CREATE - Créer un message - message_create
    #[Route('/', name: 'message_create', methods: ['POST'])]
    public function createMessage(Request $request, ValidatorInterface $validator, EntityManagerInterface $entityManager): Response {
        // Décodage et validation des données d'entrée
        $data = json_decode($request->getContent(), true);
    
        $constraints = new Assert\Collection([
            'content' => [new Assert\NotBlank(), new Assert\Length(['min' => 5])],
            'senderId' => new Assert\NotNull(),
            'sceneId' => new Assert\Optional([new Assert\NotNull()]),
            'artisteId' => new Assert\Optional([new Assert\NotNull()]) 
        ]);
    
        $violations = $validator->validate($data, $constraints);
    
        if (count($violations) > 0) {
            $errors = [];
            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }
            return $this->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }
    
        // Création et sauvegarde de l'entité Message
        $message = new Message();
        $message->setContent($data['content']);
        
        // Récupération de l'expéditeur, de la scène, et de l'artiste à partir de leur ID
        $sender = $entityManager->getRepository(User::class)->find($data['senderId']);
        if ($sender) {
            $message->setUser($sender);
        } else {
            return $this->json(['error' => 'Sender not found'], Response::HTTP_BAD_REQUEST);
        }
    
        if (!empty($data['sceneId'])) {
            $scene = $entityManager->getRepository(Scene::class)->find($data['sceneId']);
            if ($scene) {
                $message->setScene($scene);
            }
        }
    
        if (!empty($data['artisteId'])) {
            $artiste = $entityManager->getRepository(Artist::class)->find($data['artisteId']);
            if ($artiste) {
                $message->setArtist($artiste);
            }
        }
    
        $entityManager->persist($message);
        $entityManager->flush();
    
        return $this->json($message, Response::HTTP_CREATED, [], ['groups' => 'message:read']);
    }

    // READ - Lire tous les messages - message_list
    #[Route('/', name: 'message_list', methods: ['GET'])]
    public function listMessages(MessageRepository $repository): Response
    {
        $messages = $repository->findAll();
        return $this->json($messages, Response::HTTP_OK, [], ['groups' => 'message:read']);
    }

    // READ - Lire UN message - message_show
    #[Route('/{id}', name: 'message_show', methods: ['GET'])]
    public function showMessage(Message $message): Response
    {
        return $this->json($message, Response::HTTP_OK, [], ['groups' => 'message:read']);
    }

    // DELETE - Supprimer un message - message_delete
    #[Route('/{id}', name: 'message_delete', methods: ['DELETE'])]
    public function deleteMessage(EntityManagerInterface $entityManager, Message $message): Response
    {
        $entityManager->remove($message);
        $entityManager->flush();

        return $this->json(['status' => 'Message deleted']);
    }
}

