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
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(SceneRepository $sceneRepository, SerializerInterface $serializer): JsonResponse
    {
        $scenes = $sceneRepository->findAll();
        $jsonScenes = $serializer->serialize($scenes, 'json', ['groups' => 'public:read']);
        return new JsonResponse($jsonScenes, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(SceneRepository $sceneRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $scene = $sceneRepository->find($id);
        if (!$scene) {
            return new JsonResponse(['error' => 'Scene not found'], Response::HTTP_NOT_FOUND);
        }
        $jsonScene = $serializer->serialize($scene, 'json', ['groups' => 'public:read']);
        return new JsonResponse($jsonScene, Response::HTTP_OK, [], true);
    }

    #[Route('/', name: 'create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer): JsonResponse
    {
        $scene = $serializer->deserialize($request->getContent(), Scene::class, 'json', ['groups' => 'scene:write']);

        $errors = $validator->validate($scene);
        if (count($errors) > 0) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($scene);
        $entityManager->flush();

        $jsonScene = $serializer->serialize($scene, 'json', ['groups' => 'scene:read']);
        return new JsonResponse($jsonScene, Response::HTTP_CREATED, [], true);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT'])]
    public function update(Request $request, EntityManagerInterface $entityManager, SceneRepository $sceneRepository, ValidatorInterface $validator, SerializerInterface $serializer, int $id): JsonResponse
    {
        $scene = $sceneRepository->find($id);
        if (!$scene) {
            return new JsonResponse(['error' => 'Scene not found'], Response::HTTP_NOT_FOUND);
        }

        $serializer->deserialize($request->getContent(), Scene::class, 'json', ['object_to_populate' => $scene, 'groups' => 'scene:write']);

        $errors = $validator->validate($scene);
        if (count($errors) > 0) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        $entityManager->flush();

        $jsonScene = $serializer->serialize($scene, 'json', ['groups' => 'scene:read']);
        return new JsonResponse($jsonScene, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager, SceneRepository $sceneRepository, int $id): JsonResponse
    {
        $scene = $sceneRepository->find($id);
        if (!$scene) {
            return new JsonResponse(['error' => 'Scene not found'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($scene);
        $entityManager->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}