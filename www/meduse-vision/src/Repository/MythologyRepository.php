<?php

namespace App\Repository;

use App\Entity\Mythology;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mythology>
 *
 * @method Mythology|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mythology|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mythology[]    findAll()
 * @method Mythology[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MythologyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mythology::class);
    }

//    /**
//     * @return Mythology[] Returns an array of Mythology objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Mythology
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
