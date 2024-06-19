<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    // Fonction pour trouver les FUTURS évènements par rapport à la date actuelle
    // public function EventsUpComing($slug)
    // {
    //     $qb = $this->createQueryBuilder('e')
    //         ->where('e.dateTime > :now')
    //         ->andWhere('e.slug = :slug')
    //         ->orderBy('e.dateTime', 'ASC')
    //         ->setParameter('now', new \DateTime(), \Doctrine\DBAL\Types\Types::DATETIME_MUTABLE)
    //         ->setParameter('slug', $slug)
    //         ->getQuery();

    //     return $qb->getResult();
    // }

    // fonction pour lire tous les évènements à venir en fonction de la date actuelle
    public function EventsUpComingAll()
    {
        $qb = $this->createQueryBuilder('e')
            ->join('e.scene', 's') 
            ->addSelect('s')
            ->where('e.dateTime > :now')
            ->orderBy('e.dateTime', 'ASC')
            ->setParameter('now', new \DateTime(), \Doctrine\DBAL\Types\Types::DATETIME_MUTABLE)
            ->getQuery();
    
        return $qb->getResult();
    }

    // Fonctions pour trouver TOUS les évenements d'une scène
    public function findByScene($slug)
    {
        $qb = $this->createQueryBuilder('e')
            ->innerJoin('e.scene', 's') // 'scene' est le nom de la propriété dans EVENT qui fait référence à SCENE
            ->where('s.id = :sceneId') // Utilise l'identifiant de la scène pour filtrer les événements
            ->setParameter('slug', $slug)
            ->getQuery();

        return $qb->getResult();
    }
}