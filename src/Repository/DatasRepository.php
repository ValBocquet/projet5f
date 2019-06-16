<?php

namespace App\Repository;

use App\Entity\Datas;
use App\Entity\Users;
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

    public function findAllVisibleQuery(Users $userId) {

        return $this->createQueryBuilder('p')
            ->where('p.idUser = :idUser')
            ->orderBy('p.create_at', 'DESC')
            ->setParameter('idUser', $userId)
            ->getQuery()
            ->getResult();

    }


}