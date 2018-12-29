<?php

namespace App\Repository;

use App\Entity\LabDayTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LabDayTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method LabDayTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method LabDayTeam[]    findAll()
 * @method LabDayTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LabDayTeamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LabDayTeam::class);
    }

    // /**
    //  * @return LabDayTeam[] Returns an array of LabDayTeam objects
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
    public function findOneBySomeField($value): ?LabDayTeam
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
