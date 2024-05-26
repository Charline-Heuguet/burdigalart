<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Style;
use App\Entity\Artist;
use App\Entity\Category;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/artists', name: 'artist_')]
class ArtistController extends AbstractController
{
    // Pour LISTER les artistes
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ArtistRepository $artistRepository, SerializerInterface $serializer): JsonResponse
    {
        $artists = $artistRepository->findAll();
        // Sérialiser les artistes pour la réponse, en utilisant le groupe de lecture
        $jsonArtists = $serializer->serialize($artists, 'json', ['groups' => ['artist:index']]);
        return new JsonResponse($jsonArtists, Response::HTTP_OK, [], true);
    }

    // READ - Pour montrer un artiste VIA son slug
    #[Route('/{slug}', name: 'showSlug', methods: ['GET'], requirements: ['slug' => '[a-zA-Z0-9\-_]+'])]
    public function showSlug(ArtistRepository $artistRepository, SerializerInterface $serializer, $slug): JsonResponse
    {
        $artist = $artistRepository->findOneBySlug($slug);
        if (!$artist) {
            return new JsonResponse(['error' => 'Artist not found, sorry !'], Response::HTTP_NOT_FOUND);
        }
        $jsonArtist = $serializer->serialize($artist, 'json', ['groups' => ['artist:show', 'artist_scene:show']]);
        return new JsonResponse($jsonArtist, Response::HTTP_OK, [], true);
    }

    // READ - Pour montrer un artiste
    #[Route('/id/{id}', name: 'show', methods: ['GET'])]
    public function show(ArtistRepository $artistRepository, SerializerInterface $serializer, $id): JsonResponse
    {
        $artist = $artistRepository->find($id);
        if (!$artist) {
            return new JsonResponse(['error' => 'Artist not found :('], Response::HTTP_NOT_FOUND);
        }
        $jsonArtist = $serializer->serialize($artist, 'json', ['groups' => ['artist:show', 'artist_scene:show']]);
        return new JsonResponse($jsonArtist, Response::HTTP_OK, [], true);
    }


    // CREATE - Créer un artiste
    #[Route('/', name: 'create', methods: ['POST'])]
    // Dans la méthode de création de l'ArtistController
    public function create(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {
        $artistData = json_decode($request->getContent(), true);
    
        // Charger l'utilisateur
        $user = $entityManager->getRepository(User::class)->find($artistData['user_id']);
        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_BAD_REQUEST);
        }
    
        // Charger les entités Category et Style
        $category = $entityManager->getRepository(Category::class)->find($artistData['category']);
        $style = $entityManager->getRepository(Style::class)->find($artistData['style']);
        if (!$category || !$style) {
            return new JsonResponse(['error' => 'Category or style not found'], Response::HTTP_BAD_REQUEST);
        }
    
        $artist = $serializer->deserialize($request->getContent(), Artist::class, 'json');
        $artist->setUser($user);
        $artist->setCategory($category);
        $artist->setStyle($style);
        // Générer le slug
        $artist->updateSlug();
        // Valider et persister l'entité
        $errors = $validator->validate($artist);
        if (count($errors) > 0) {
            $errorsArray = [];
            foreach ($errors as $error) {
                $errorsArray[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorsArray], Response::HTTP_BAD_REQUEST);
        }        
    
        $entityManager->persist($artist);
        $entityManager->flush();
    
        return new JsonResponse($serializer->serialize($artist, 'json', ['groups' => ['artist:index', 'artist:show']]), Response::HTTP_CREATED, [], true);
    }
    


    // UPDATE - modifier un artiste
    #[Route('/{slug}', name: 'update', methods: ['PUT'])]
    public function update(Request $request, EntityManagerInterface $entityManager, ArtistRepository $artistRepository, ValidatorInterface $validator, SerializerInterface $serializer, $slug): JsonResponse
    {
        $artist = $artistRepository->findOneBySlug($slug);
        if (!$artist) {
            return new JsonResponse(['error' => 'Artist not found'], Response::HTTP_NOT_FOUND);
        }

        // Désérialiser le contenu JSON de la requête dans l'objet Artist existant
        $serializer->deserialize($request->getContent(), Artist::class, 'json', [
            'object_to_populate' => $artist,
            'groups' => 'artist:update'
        ]);

        // Valider l'entité désérialisée
        $errors = $validator->validate($artist);
        if (count($errors) > 0) {
            // Formater les erreurs de validation pour la réponse JSON
            $errorsArray = [];
            foreach ($errors as $error) {
                $errorsArray[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorsArray], Response::HTTP_BAD_REQUEST);
        }

        // Doctrine connaît déjà cet artiste, donc pas besoin de persister
        $entityManager->flush();

        // Sérialiser l'artiste pour la réponse, en utilisant le groupe de lecture
        $jsonArtist = $serializer->serialize($artist, 'json', ['groups' => 'artist:show']);
        return new JsonResponse($jsonArtist, Response::HTTP_OK, [], true);
    }


    // DELETE - Pour SUPPRIMER un artiste par son slug
    #[Route('/{slug}', name: 'delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager, ArtistRepository $artistRepository, $slug): JsonResponse
    {
        $artist = $artistRepository->find($slug);
        if (!$artist) {
            return new JsonResponse(['error' => 'Artist not found with this id'], Response::HTTP_NOT_FOUND);
        }
        $entityManager->remove($artist);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Artist deleted']);
    }

    // Accéder aux infos de l'artiste via l'ID de l'utilisateur connecté (=> afin de RECUPERER les infos de l'artiste SI la fiche artiste existe pour cet utilisateur)
    #[Route('/user/{id}', name: 'artist_by_user', methods: ['GET'])]
    public function getArtistByUser(ArtistRepository $artistRepository, SerializerInterface $serializer, int $id,): JsonResponse
    {
        $artist = $artistRepository->findOneBy(['user' => $id]);
        if (!$artist) {
            return new JsonResponse(['error' => 'Artist not found :( '], Response::HTTP_NOT_FOUND);
        }
        $jsonArtist = $serializer->serialize($artist, 'json', ['groups' => ['artist:show']]);
        return new JsonResponse($jsonArtist, Response::HTTP_OK, [], true);
    }

    // DELETE - Pour SUPPRIMER un artiste par son id
    // #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    // public function delete(EntityManagerInterface $entityManager, ArtistRepository $artistRepository, $id): JsonResponse
    // {
    //     $artist = $artistRepository->find($id);
    //     if (!$artist) {
    //         return new JsonResponse(['error' => 'Artist not found with this id'], Response::HTTP_NOT_FOUND);
    //     }
    //     $entityManager->remove($artist);
    //     $entityManager->flush();

    //     return new JsonResponse(['status' => 'Artist deleted']);
    // }

}
