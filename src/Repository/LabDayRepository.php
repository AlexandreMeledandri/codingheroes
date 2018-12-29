<?php

namespace App\Repository;

use App\Entity\LabDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LabDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method LabDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method LabDay[]    findAll()
 * @method LabDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LabDayRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LabDay::class);
    }

    // /**
    //  * @return LabDay[] Returns an array of LabDay objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LabDay
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
