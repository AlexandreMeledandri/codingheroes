<?php

namespace App\Repository;

use App\Entity\PersonalSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PersonalSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonalSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonalSkill[]    findAll()
 * @method PersonalSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonalSkillRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PersonalSkill::class);
    }

    // /**
    //  * @return PersonalSkill[] Returns an array of PersonalSkill objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PersonalSkill
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
