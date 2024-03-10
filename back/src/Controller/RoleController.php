<?php

namespace App\Controller;

use App\Repository\RoleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/roles', name:'role_')]
class RoleController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(RoleRepository $roleRepository, SerializerInterface $serializer): JsonResponse
    {
        $roles = $roleRepository->findAll();
        $jsonRoles = $serializer->serialize($roles, 'json', ['groups' => 'role:index']);
        return new JsonResponse($jsonRoles, Response::HTTP_OK, [], true);
    }
}
