<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

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

        return $this->json([
            'name' => $user->getName(),
            'firstName' => $user->getFirstName(),
            'picture' => $user->getPicture(), 
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'artists' => $user->getArtists(),
            'scenes' => $user->getScenes(),
            'events' => $user->getEvents(),
        ], Response::HTTP_OK, [], ['groups' => 'user:show']);
    }

    // UPDATE - Modifier un utilisateur
    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function update(EntityManagerInterface $entityManager, Request $request, UserRepository $userRepository, int $id, ValidatorInterface $validator): JsonResponse
    {
        $user = $userRepository->find($id);
        if (!$user) {
            return $this->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $user->setName($data['name'] ?? $user->getName());
        $user->setFirstName($data['firstName'] ?? $user->getFirstName());
        $user->setEmail($data['email'] ?? $user->getEmail());

        // Ajoute la gestion des erreurs de validation ici
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return $this->json(['errors' => (string) $errors], Response::HTTP_BAD_REQUEST);
        }

        $entityManager->flush();
        return $this->json(['message' => 'User updated successfully'], Response::HTTP_OK);
    }

    // DELETE - Supprimer un utilisateur (avec vérification des rôles)
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $roles = $user->getRoles();
        if (count($roles) === 1 && in_array("ROLE_USER", $roles)) {
            $entityManager->remove($user);
            $entityManager->flush();
            return new JsonResponse(['message' => 'Utilisateur supprimé avec succès.'], Response::HTTP_OK);
        } else {
            return new JsonResponse(['error' => 'Cet utilisateur ne peut pas être supprimé car il possède d’autres rôles.'], Response::HTTP_FORBIDDEN);
        }
    }

    // SIGNUP - Inscription
    #[Route('/signup', name: 'signup', methods: ['POST'])]
    public function signup(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        // Désérialiser la requête en objet User
        $user = $serializer->deserialize($request->getContent(), User::class, 'json', ['groups' => 'user:signup']);

        // Afficher les rôles pour le débogage
        error_log(print_r($user->getRoles(), true));

        // Hasher le mot de passe
        $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));

        // Ajouter ROLE_USER par défaut (si pas déjà inclus)
        $currentRoles = $user->getRoles();
        if (!in_array('ROLE_USER', $currentRoles)) {
            $user->setRoles(array_merge($currentRoles, ['ROLE_USER']));
        }

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

    // LOGOUT - Déconnexion
    #[Route('/logout', name: 'logout', methods: ['POST'])]
    public function logout(): JsonResponse
    {
        return $this->json(['message' => 'Logout successful'], Response::HTTP_OK);
    }

}
