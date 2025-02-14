<?php

namespace App\Repository;

use App\Entity\NotiFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NotiFile>
 *
 * @method NotiFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotiFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotiFile[]    findAll()
 * @method NotiFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotiFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotiFile::class);
    }

//    /**
//     * @return NotiFile[] Returns an array of NotiFile objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NotiFile
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
