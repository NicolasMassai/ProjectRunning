<?php

namespace App\Repository;

use App\Entity\Convertisseur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Convertisseur>
 *
 * @method Convertisseur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Convertisseur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Convertisseur[]    findAll()
 * @method Convertisseur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConvertisseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Convertisseur::class);
    }

//    /**
//     * @return Convertisseur[] Returns an array of Convertisseur objects
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

//    public function findOneBySomeField($value): ?Convertisseur
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
