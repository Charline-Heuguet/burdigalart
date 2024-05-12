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
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
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

    // SIGNUP - Inscription
    #[Route('/signup', name: 'signup', methods: ['POST'])]
    public function signup(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        // Désérialiser la requête en objet User
        $user = $serializer->deserialize($request->getContent(), User::class, 'json', ['groups' => 'user:signup']);

        // Hasher le mot de passe
        $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));

        // Valider l'objet User
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return $this->json(['errors' => $errorMessages], Response::HTTP_BAD_REQUEST);
        }

        // Persister et enregistrer l'objet User
        $entityManager->persist($user);
        $entityManager->flush();

        // Retourner l'utilisateur créé
        return $this->json($user, Response::HTTP_CREATED, [], ['groups' => 'user:show']);
    }

    // LOGIN - Connexion
    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(Request $request, UserRepository $userRepository, JWTTokenManagerInterface $JWTManager, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        // Récupérer les données de la requête
        $data = json_decode($request->getContent(), true);
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        // Vérifier si l'utilisateur existe
        $user = $userRepository->findOneBy(['email' => $email]);
        if (!$user) {
            return $this->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        // Vérifier si le mot de passe est correct
        if (!$passwordHasher->isPasswordValid($user, $password)) {
            return $this->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        // Générer le token JWT
        $token = $JWTManager->create($user);

        // Retourner le token JWT
        return $this->json(['token' => $token], Response::HTTP_OK);
    }

}
