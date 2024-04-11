<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/events', name: 'event')]
class EventController extends AbstractController
{
    // READ - Lire tous les événements - event:index
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(EventRepository $eventRepository, SerializerInterface $serializer): JsonResponse
    {
        $events = $eventRepository->findAll();
        $jsonEvents = $serializer->serialize($events, 'json', ['groups' => 'event:index']);
        return new JsonResponse($jsonEvents, Response::HTTP_OK, [], true);
    }

    // READ - Lire un événement via son slug (url friendly) - event:show
    #[Route('/{slug}', name: 'showSlug', methods: ['GET'])]
    public function showSlug(EventRepository $eventRepository, SerializerInterface $serializer, string $slug): JsonResponse
    {
        $event = $eventRepository->findOneBySlug($slug);
        if (!$event) {
            return new JsonResponse(['error' => 'Event not found'], Response::HTTP_NOT_FOUND);
        }
        $jsonEvent = $serializer->serialize($event, 'json', ['groups' => 'event:show']);
        return new JsonResponse($jsonEvent, Response::HTTP_OK, [], true);
    }

    // Les événements à venir - event:upcoming
    #[Route('/upcoming', name: 'upcoming', methods: ['GET'])]
    public function upcoming(EventRepository $eventRepository, SerializerInterface $serializer): JsonResponse
    {
        $events = $eventRepository->findUpcomingEvents();
        $jsonEvents = $serializer->serialize($events, 'json', ['groups' => 'event:upcoming']);
        return new JsonResponse($jsonEvents, Response::HTTP_OK, [], true);
    }

    // CREATE - Créer un événement - event:create
    #[Route('/', name: 'create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer): JsonResponse {

        // Désérialiser le contenu JSON de la requête en une instance de l'entité Event
        $event = $serializer->deserialize($request->getContent(), Event::class, 'json', ['groups' => 'event:create']);

        // Valider l'entité Event qui est deserializée
        $errors = $validator->validate($event);
        if (count($errors) > 0) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($event);
        $entityManager->flush();

        $jsonEvent = $serializer->serialize($event, 'json', ['groups' => 'event:show']);
        return new JsonResponse($jsonEvent, Response::HTTP_CREATED, [], true);
    }

    // UPDATE - Mettre à jour un événement - event:update
    #[Route('/{slug}', name: 'update', methods: ['PUT'])]
    public function update(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer, string $slug): JsonResponse
    {
        $event = $entityManager->getRepository(Event::class)->findOneBySlug($slug);
        if (!$event) {
            return new JsonResponse(['error' => 'Event not found'], Response::HTTP_NOT_FOUND);
        }

        $serializer->deserialize($request->getContent(), Event::class, 'json', ['object_to_populate' => $event, 'groups' => 'event:update']);

        $errors = $validator->validate($event);
        if (count($errors) > 0) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        $entityManager->flush();

        $jsonEvent = $serializer->serialize($event, 'json', ['groups' => 'event:show']);
        return new JsonResponse($jsonEvent, Response::HTTP_OK, [], true);
    }

    // DELETE - Supprimer un événement - event:delete
    #[Route('/{slug}', name: 'delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager, string $slug): JsonResponse
    {
        $event = $entityManager->getRepository(Event::class)->findOneBySlug($slug);
        if (!$event) {
            return new JsonResponse(['error' => 'Event not found'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($event);
        $entityManager->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }


}
