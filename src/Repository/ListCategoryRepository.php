<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ListCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListCategory>
 *
 * @method ListCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListCategory[]    findAll()
 * @method ListCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListCategory::class);
    }

    public function add(ListCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ListCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
