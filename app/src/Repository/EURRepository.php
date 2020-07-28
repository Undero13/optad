<?php

namespace App\Repository;

use App\Entity\EUR;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EUR|null find($id, $lockMode = null, $lockVersion = null)
 * @method EUR|null findOneBy(array $criteria, array $orderBy = null)
 * @method EUR[]    findAll()
 * @method EUR[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EURRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EUR::class);
    }
}
