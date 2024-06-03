<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Style;
use App\Entity\Artist;
use App\Entity\Category;
use Psr\Log\LoggerInterface;
use App\Repository\StyleRepository;
use App\Repository\ArtistRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
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
            return new JsonResponse(['error' => 'Artist not found, sorry !!!'], Response::HTTP_NOT_FOUND);
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
public function create(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator, Security $security): JsonResponse
{
    // Obtenir l'utilisateur actuellement connecté
    /** @var User $user */
    $user = $security->getUser();

    if (!$user) {
        return new JsonResponse(['error' => 'Authentication required'], Response::HTTP_UNAUTHORIZED);
    }

    $userId = $user->getId(); // Assure-toi que ta classe User a une méthode getId()
    if (!$userId) {
        return new JsonResponse(['error' => 'User ID is missing'], Response::HTTP_BAD_REQUEST);
    }

    $artistData = json_decode($request->getContent(), true);

    // Vérifier si l'utilisateur a déjà un artiste
    $existingArtist = $entityManager->getRepository(Artist::class)->findOneBy(['user' => $user]);
    if ($existingArtist) {
        return new JsonResponse(['error' => 'User already has an artist profile'], Response::HTTP_BAD_REQUEST);
    }

    // Charger les entités Category et Style
    $category = $entityManager->getRepository(Category::class)->find($artistData['category']);
    $style = $entityManager->getRepository(Style::class)->find($artistData['style']);
    if (!$category || !$style) {
        return new JsonResponse(['error' => 'Category or style not found'], Response::HTTP_BAD_REQUEST);
    }

    try {
        $artist = $serializer->deserialize($request->getContent(), Artist::class, 'json');
        $artist->setUser($user);
        $artist->setCategory($category);
        $artist->setStyle($style);
        $artist->updateSlug();
    } catch (\Exception $e) {
        return new JsonResponse(['error' => 'Error processing request: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

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
    public function update(Request $request,EntityManagerInterface $entityManager,ArtistRepository $artistRepository,CategoryRepository $categoryRepository,StyleRepository $styleRepository, SerializerInterface $serializer, ValidatorInterface $validator,LoggerInterface $logger,$slug): JsonResponse 
    {
        $artist = $artistRepository->findOneBySlug($slug);
        if (!$artist) {
            return new JsonResponse(['error' => 'Artist not found'], Response::HTTP_NOT_FOUND);
        }

        $artistData = json_decode($request->getContent(), true);
        $logger->info('Received artist data:', $artistData);

        // Handling category
        $categoryId = $artistData['category']['id'] ?? null;
        $category = $categoryId ? $categoryRepository->find($categoryId) : null;
        if (!$category) {
            return new JsonResponse(['error' => 'Category not found'], Response::HTTP_BAD_REQUEST);
        }

        // Handling style
        $styleId = $artistData['style']['id'] ?? null;
        $style = $styleId ? $styleRepository->find($styleId) : null;
        if (!$style) {
            return new JsonResponse(['error' => 'Style not found'], Response::HTTP_BAD_REQUEST);
        }

        // Set category and style
        $artist->setCategory($category);
        $artist->setStyle($style);

        // Other fields update
        $artist->setArtistName($artistData['artistName'] ?? $artist->getArtistName());
        $artist->setDescription($artistData['description'] ?? $artist->getDescription());
        $artist->setOfficialPhoto($artistData['official_photo'] ?? $artist->getOfficialPhoto());
        $artist->setLinkExcerpt($artistData['linkExcerpt'] ?? $artist->getLinkExcerpt());
        $artist->setInstagram($artistData['instagram'] ?? $artist->getInstagram());
        $artist->setFacebook($artistData['facebook'] ?? $artist->getFacebook());
        $artist->setShowPhoto($artistData['showPhoto'] ?? $artist->getShowPhoto());
        $artist->setShowTitle($artistData['showTitle'] ?? $artist->getShowTitle());
        $artist->setShowDescription($artistData['showDescription'] ?? $artist->getShowDescription());

        // Validate the entity
        $errors = $validator->validate($artist);
        if (count($errors) > 0) {
            $errorsArray = [];
            foreach ($errors as $error) {
                $errorsArray[$error->getPropertyPath()] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorsArray], Response::HTTP_BAD_REQUEST);
        }

        // Save the changes
        $entityManager->flush();

        return new JsonResponse($serializer->serialize($artist, 'json', ['groups' => 'artist:show']), Response::HTTP_OK, [], true);
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


    // Pour lire TOUS les artistes du USER connecté
    #[Route('/user/byuser', name: 'by_user', methods: ['GET'])]
    public function getArtistsByUser(ArtistRepository $artistRepository, SerializerInterface $serializer): JsonResponse
    {
        $artists = $artistRepository->findBy(['user' => $this->getUser()]);
        $jsonArtists = $serializer->serialize($artists, 'json', ['groups' => ['artist:index', 'artist:show']]);
        return new JsonResponse($jsonArtists, Response::HTTP_OK, [], true);
    }


    // Lire les infos d'UN ARTISTE via l'ID L'UTILISATEUR connecté (=> afin de RECUPERER les infos de l'artiste SI la fiche artiste existe pour cet utilisateur)
    // #[Route('/user/{id}', name: 'artist_by_user', methods: ['GET'])]
    // public function getArtistByUser(ArtistRepository $artistRepository, SerializerInterface $serializer, int $id,): JsonResponse
    // {
    //     $artist = $artistRepository->findOneBy(['user' => $id]);
    //     if (!$artist) {
    //         return new JsonResponse(['error' => 'Artist not found :( '], Response::HTTP_NOT_FOUND);
    //     }
    //     $jsonArtist = $serializer->serialize($artist, 'json', ['groups' => ['artist:index', 'artist:show']]);
    //     return new JsonResponse($jsonArtist, Response::HTTP_OK, [], true);
    // }


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
