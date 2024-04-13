<?php

namespace App\Controller;

use App\Entity\Scene;
use App\Repository\SceneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/scenes', name: 'scene_')]
class SceneController extends AbstractController
{
    // Liste des scènes : scene:index
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(SceneRepository $sceneRepository, SerializerInterface $serializer): JsonResponse
    {
        $scenes = $sceneRepository->findAll();
        $jsonScenes = $serializer->serialize($scenes, 'json', ['groups' => 'scene:index']);
        return new JsonResponse($jsonScenes, Response::HTTP_OK, [], true);
    }

    // // Listes de tous les évènements de toutes les scènes.
    // #[Route('/allupcoming', name: 'allUpcoming', methods: ['GET'])]
    // public function allUpcoming(SceneRepository $sceneRepository, SerializerInterface $serializer): JsonResponse
    // {
    //     $scenes = $sceneRepository->findUpcomingAllScenes();
    //     $jsonScenes = $serializer->serialize($scenes, 'json', ['groups' => 'scene:upcoming']);
    //     return new JsonResponse($jsonScenes, Response::HTTP_OK, [], true);
    // }


    // READ : lire une scene via son slug
    #[Route('/{slug}', name: 'showSlug', methods: ['GET'], requirements: ['slug' => '[a-zA-Z0-9\-_]+'])]
    public function showSlug(SceneRepository $sceneRepository, SerializerInterface $serializer, string $slug): JsonResponse
    {
        $scene = $sceneRepository->findOneBySlug($slug);
        if (!$scene) {
            return new JsonResponse(['error' => 'Scene not found'], Response::HTTP_NOT_FOUND);
        }
        $jsonScene = $serializer->serialize($scene, 'json', ['groups' => ['scene:show', 'scene_artist:show']]);
        return new JsonResponse($jsonScene, Response::HTTP_OK, [], true);
    }

    // // READ : lire une scene via son id
    #[Route('/id/{id}', name: 'showId', methods: ['GET'])]
    public function showId(SceneRepository $sceneRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $scene = $sceneRepository->find($id);
        if (!$scene) {
            return new JsonResponse(['error' => 'Scene not found'], Response::HTTP_NOT_FOUND);
        }
        $jsonScene = $serializer->serialize($scene, 'json', ['groups' => 'scene:show']);
        return new JsonResponse($jsonScene, Response::HTTP_OK, [], true);
    }

    // // Les évènements à venir d'une scène : scene:upcoming
    // #[Route('/{slug}/upcoming', name: 'upcoming', methods: ['GET'])]
    // public function upcoming($slug, SceneRepository $sceneRepository, SerializerInterface $serializer): JsonResponse
    // {
    //     $scenes = $sceneRepository->sceneEvents($slug);
    //     $jsonScenes = $serializer->serialize($scenes, 'json', ['groups' => 'scene:upcoming']);
    //     return new JsonResponse($jsonScenes, Response::HTTP_OK, [], true);
    // }

    // CREATE : scene:create
    #[Route('/', name: 'create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer): JsonResponse
    {
        $scene = $serializer->deserialize($request->getContent(), Scene::class, 'json', ['groups' => 'scene:create']);

        $errors = $validator->validate($scene);
        if (count($errors) > 0) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($scene);
        $entityManager->flush();

        $jsonScene = $serializer->serialize($scene, 'json', ['groups' => 'scene:show']);
        return new JsonResponse($jsonScene, Response::HTTP_CREATED, [], true);
    }

    // UPDATE : scene:update 
    #[Route('/{slug}', name: 'update', methods: ['PUT'])]
    public function update(Request $request, EntityManagerInterface $entityManager, SceneRepository $sceneRepository, ValidatorInterface $validator, SerializerInterface $serializer, $slug): JsonResponse
    {
        $scene = $sceneRepository->findOneBySlug($slug);
        if (!$scene) {
            return new JsonResponse(['error' => 'Scene not found'], Response::HTTP_NOT_FOUND);
        }

        $serializer->deserialize($request->getContent(), Scene::class, 'json', ['object_to_populate' => $scene, 'groups' => 'scene:update']);

        $errors = $validator->validate($scene);
        if (count($errors) > 0) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        $entityManager->flush();

        $jsonScene = $serializer->serialize($scene, 'json', ['groups' => 'scene:show']);
        return new JsonResponse($jsonScene, Response::HTTP_OK, [], true);
    }

    // DELETE 
    // #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    // public function delete(EntityManagerInterface $entityManager, SceneRepository $sceneRepository, int $id): JsonResponse
    // {
    //     $scene = $sceneRepository->find($id);
    //     if (!$scene) {
    //         return new JsonResponse(['error' => 'Scene not found'], Response::HTTP_NOT_FOUND);
    //     }

    //     $entityManager->remove($scene);
    //     $entityManager->flush();

    //     return new JsonResponse(['message' => 'Scene deleted'], Response::HTTP_NO_CONTENT);
    // }

    #[Route('/{slug}', name: 'delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager, SceneRepository $sceneRepository, $slug): JsonResponse
    {
        $scene = $sceneRepository->find($slug);
        if (!$scene) {
            return new JsonResponse(['error' => 'Scene not found'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($scene);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Scene deleted'], Response::HTTP_NO_CONTENT);
    }

}
