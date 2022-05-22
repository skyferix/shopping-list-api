<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ListGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListGroup>
 *
 * @method ListGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListGroup[]    findAll()
 * @method ListGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListGroup::class);
    }

    public function add(ListGroup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ListGroup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
