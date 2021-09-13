<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findCategoryMenu()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.category_parent IS NULL')
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY) // retourne un tableau de données
        ;
    }

    public function findSubCategoryMenu($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.category_parent = :val')
            ->setParameter('val', $value) // sécurise le code, au lieu de mettre andWhere('c.exampleField = $value')
            ->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY) // retourne un tableau de données
        ;
    }

    // /**
    //  * @return Category[] Returns an array of Category objects
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
    public function findOneBySomeField($value): ?Category
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
