<?php

namespace App\Repository;

use App\Entity\ConfigProject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConfigProject>
 *
 * @method ConfigProject|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConfigProject|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConfigProject[]    findAll()
 * @method ConfigProject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfigProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConfigProject::class);
    }

    //    /**
    //     * @return ConfigProject[] Returns an array of ConfigProject objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ConfigProject
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
