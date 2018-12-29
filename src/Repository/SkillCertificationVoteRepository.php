<?php

namespace App\Repository;

use App\Entity\SkillCertificationVote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SkillCertificationVote|null find($id, $lockMode = null, $lockVersion = null)
 * @method SkillCertificationVote|null findOneBy(array $criteria, array $orderBy = null)
 * @method SkillCertificationVote[]    findAll()
 * @method SkillCertificationVote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillCertificationVoteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SkillCertificationVote::class);
    }

    // /**
    //  * @return SkillCertificationVote[] Returns an array of SkillCertificationVote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SkillCertificationVote
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
