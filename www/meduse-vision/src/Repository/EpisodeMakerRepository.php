<?php

namespace App\Repository;

use App\Entity\EpisodeMaker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EpisodeMaker>
 *
 * @method EpisodeMaker|null find($id, $lockMode = null, $lockVersion = null)
 * @method EpisodeMaker|null findOneBy(array $criteria, array $orderBy = null)
 * @method EpisodeMaker[]    findAll()
 * @method EpisodeMaker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EpisodeMakerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EpisodeMaker::class);
    }

    public function findByFilters(array $filters)
    {
        $qb = $this->createQueryBuilder('e');

        if (!empty($filters['type'])) {
            $qb->andWhere('e.type = :type')
               ->setParameter('type', $filters['type']);
        }

        if (!empty($filters['status'])) {
            $qb->andWhere('e.status = :status')
               ->setParameter('status', $filters['status']);
        }

        if (!empty($filters['reminder'])) {
            $qb->andWhere('e.reminder = :reminder')
               ->setParameter('reminder', $filters['reminder']);
        }

        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return EpisodeProgress[] Returns an array of EpisodeProgress objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EpisodeProgress
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
