<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ProductList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductList>
 *
 * @method ProductList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductList[]    findAll()
 * @method ProductList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductList::class);
    }

    public function add(ProductList $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProductList $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
