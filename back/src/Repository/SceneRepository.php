<?php

namespace App\Repository;

use App\Entity\Scene;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Scene>
 *
 * @method Scene|null find($id, $lockMode = null, $lockVersion = null)
 * @method Scene|null findOneBy(array $criteria, array $orderBy = null)
 * @method Scene[]    findAll()
 * @method Scene[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SceneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Scene::class);
    }

    // Fonction pour récupérer les évènements à venir d'UNE scène
    public function sceneEvents($slug)
    {
        $qb = $this->createQueryBuilder('s')
            ->where('s.eventDateTime > :now')
            ->andWhere('s.slug = :slug')
            ->orderBy('s.eventDateTime', 'ASC')
            ->setParameter('now', new \DateTime(), \Doctrine\DBAL\Types\Types::DATETIME_MUTABLE)
            ->setParameter('slug', $slug)
            ->getQuery();

        return $qb->getResult();
    }

    public function findUpcomingAllScenes()
    {
        $qb = $this->createQueryBuilder('s')
            ->where('s.eventDateTime > :now')
            ->orderBy('s.eventDateTime', 'ASC')
            ->setParameter('now', new \DateTime(), \Doctrine\DBAL\Types\Types::DATETIME_MUTABLE)
            ->getQuery();
        return $qb->getResult();
    }

    //    /**
    //     * @return Scene[] Returns an array of Scene objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Scene
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
