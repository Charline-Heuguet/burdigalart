<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/api/users', name: 'user_')]
class UserController extends AbstractController
{

    // Lister tous les utilisateurs
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(UserRepository $userRepository): JsonResponse
    {
        $users = $userRepository->findAll();
        return $this->json($users, Response::HTTP_OK, [], ['groups' => 'user:index']);
    }

        // Lister tous les utilisateurs
        // #[Route('/teub', name: 'index_teub', methods: ['GET'])]
        // public function teub(UserRepository $userRepository): JsonResponse
        // {
        //     for(i = 100; i < 1000000; i++){
        //         $user = new User();
        //         $user->setName('name'.$i);
        //         $user->setFirstName('firstName'.$i);
        //         $user->setEmail('name
        //     }
        //     return $this->json($users, Response::HTTP_OK, [], ['groups' => 'user:index']);
        // }

    // READ - Montrer un utilisateur
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(UserRepository $userRepository, int $id): JsonResponse
    {
        $user = $userRepository->find($id);
        if (!$user) {
            return $this->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($user, Response::HTTP_OK, [], ['groups' => 'user:show']);
    }


    // CREATE - Créer un utilisateur
    #[Route('/', name: 'create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        // Désérialiser la requête en objet User
        $user = $serializer->deserialize($request->getContent(), User::class, 'json', ['groups' => 'user:create']);
        dump($user);

        // Hasher le mot de passe
        $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));

        // Valider l'objet User
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        // Persister et enregistrer l'objet User
        $entityManager->persist($user);
        $entityManager->flush();

        // Retourner l'utilisateur créé
        return $this->json($user, Response::HTTP_CREATED, [], ['groups' => 'user:show']);
    }


    // UPDATE - Modifier un utilisateur
    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function update(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository, int $id): JsonResponse
    {
        $user = $userRepository->find($id);
        if (!$user) {
            return $this->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        // Désérialiser la requête dans l'objet User existant
        $serializer->deserialize($request->getContent(), User::class, 'json', ['groups' => 'user:update', 'object_to_populate' => $user]);

        // Si mdp envoyé avec la requete => hashage sinon on garde l'ancien
        $data = json_decode($request->getContent(), true);
        if (!empty($data['password'])) {
            $user->setPassword($passwordHasher->hashPassword($user, $data['password']));
        }

        // Valider l'objet User
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        // Enregistrer les modifications
        $entityManager->flush();

        return $this->json($user, Response::HTTP_OK, [], ['groups' => 'user:show']);
    }

    // DELETE - Supprimer un utilisateur
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager, UserRepository $userRepository, int $id): JsonResponse
    {
        $user = $userRepository->find($id);
        if (!$user) {
            return $this->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->json(['message' => 'User deleted'], Response::HTTP_NO_CONTENT);
    }
}
