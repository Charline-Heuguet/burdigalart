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

    // Fonction pour récupérer UNE scène via son slug
    public function findOneBySlug(string $slug): ?Scene
    {
        return $this->createQueryBuilder('s')
            ->where('s.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
