<?php

namespace App\Repository;

use App\Entity\Telefone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Telefone|null find($id, $lockMode = null, $lockVersion = null)
 * @method Telefone|null findOneBy(array $criteria, array $orderBy = null)
 * @method Telefone[]    findAll()
 * @method Telefone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelefoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Telefone::class);
    }

    // /**
    //  * @return Telefone[] Returns an array of Telefone objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Telefone
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
