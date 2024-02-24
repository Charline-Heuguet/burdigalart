<?php

namespace App\Controller;

use App\Repository\RoleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RoleController extends AbstractController
{
    #[Route('/api/roles', name: 'roles_list', methods: ['GET'])]
public function listRoles(RoleRepository $roleRepository, SerializerInterface $serializer): JsonResponse
{
    $roles = $roleRepository->findAll();
    $jsonRoles = $serializer->serialize($roles, 'json', ['groups' => 'user:read']);
    return new JsonResponse($jsonRoles, Response::HTTP_OK, [], true);
}

}
