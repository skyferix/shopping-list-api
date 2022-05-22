<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ProductPackage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductPackage>
 *
 * @method ProductPackage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductPackage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductPackage[]    findAll()
 * @method ProductPackage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductPackageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductPackage::class);
    }

    public function add(ProductPackage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProductPackage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
