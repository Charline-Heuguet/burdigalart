<?php

namespace App\Controller;

use App\Repository\StyleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/styles', name: 'styles_')]
class StyleController extends AbstractController
{
    #[Route('/', name: 'style_index', methods: ['GET'])]
    public function index(StyleRepository $styleRepository, SerializerInterface $serializer): JsonResponse
    {
        $styles = $styleRepository->findAll();
        $jsonStyles = $serializer->serialize($styles, 'json', ['groups' => 'public:read']);
        return new JsonResponse($jsonStyles, JsonResponse::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'style_show', methods: ['GET'])]
    public function show(StyleRepository $styleRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $style = $styleRepository->find($id);
        if (!$style) {
            return new JsonResponse(['error' => 'Style not found'], JsonResponse::HTTP_NOT_FOUND);
        }
        $jsonStyle = $serializer->serialize($style, 'json', ['groups' => 'public:read']);
        return new JsonResponse($jsonStyle, JsonResponse::HTTP_OK, [], true);
    }
}
