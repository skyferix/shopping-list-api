<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ProductCount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductCount>
 *
 * @method ProductCount|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductCount|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductCount[]    findAll()
 * @method ProductCount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductCountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductCount::class);
    }

    public function add(ProductCount $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProductCount $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
