<?php

namespace App\Repository;

use App\Entity\TypeExtension;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeExtension>
 *
 * @method TypeExtension|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeExtension|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeExtension[]    findAll()
 * @method TypeExtension[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeExtensionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeExtension::class);
    }

//    /**
//     * @return TypeExtension[] Returns an array of TypeExtension objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeExtension
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
