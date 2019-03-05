<?php

namespace App\Repository\Lbr;

use App\Entity\Lbr\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    public function findAwait() {

        return $this->createQueryBuilder('c')
            ->where('c.nom is null')

            ->orWhere('c.email is null')
            ->andWhere('c.tel_1 is null')

            ->orWhere('c.categorie is null')
            ->andWhere('c.note is null')

            ->orderBy('c.created_at', 'DESC')
            ->getQuery()
            ->getResult()
        ;

    }

    public function findLastTenUpdates() {

        return $this->createQueryBuilder('c')
            ->where( 'c.updated_at is not null')
            ->orderBy('c.updated_at', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;

    } 
    // /**
    //  * @return Contact[] Returns an array of Contact objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contact
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
