<?php

namespace App\Repository;

use App\Entity\Datas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Datas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Datas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Datas[]    findAll()
 * @method Datas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Datas::class);
    }

    // /**
    //  * @return Datas[] Returns an array of Datas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Datas
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
