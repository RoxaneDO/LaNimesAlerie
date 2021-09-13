<?php

namespace App\Repository;

use App\Entity\Basket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;

/**
* @method Basket|null find($id, $lockMode = null, $lockVersion = null)
* @method Basket|null findOneBy(array $criteria, array $orderBy = null)
* @method Basket[]    findAll()
* @method Basket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
*/
class BasketRepository extends ServiceEntityRepository
{

    private $requestStack;


    public function __construct(ManagerRegistry $registry, RequestStack $requestStack)
    {
        parent::__construct($registry, Basket::class);
        $this->requestStack = $requestStack;
    }

    public function someMethod()
    {
        $session = $this->requestStack->getSession();

        // stores an attribute in the session for later reuse
        $session->set('attribute-name', 'attribute-value');

        // gets an attribute by name
        $foo = $session->get('foo');

        // the second argument is the value returned when the attribute doesn't exist
        $filters = $session->get('filters', []);

    }


    // /**
    //  * @return Basket[] Returns an array of Basket objects
    //  */
    /*
    public function findByExampleField($value)
    {
    return $this->createQueryBuilder('b')
    ->andWhere('b.exampleField = :val')
    ->setParameter('val', $value)
    ->orderBy('b.id', 'ASC')
    ->setMaxResults(10)
    ->getQuery()
    ->getResult()
    ;
}
*/

/*
public function findOneBySomeField($value): ?Basket
{
return $this->createQueryBuilder('b')
->andWhere('b.exampleField = :val')
->setParameter('val', $value)
->getQuery()
->getOneOrNullResult()
;
}
*/
}
