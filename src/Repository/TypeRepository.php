<?php

namespace App\Repository;

use App\Entity\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Type|null find($id, $lockMode = null, $lockVersion = null)
 * @method Type|null findOneBy(array $criteria, array $orderBy = null)
 * @method Type[]    findAll()
 * @method Type[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

    public function getAllTypesWithData()
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t','c','s')
            ->leftJoin('t.category','c')
            ->leftJoin('t.skills','s')
            ->orderBy('t.id');
            
            

        return $qb->getQuery()->getResult();

    }

    public function getOneTypeWithData($id)
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t','c','s')
            ->leftJoin('t.category','c')
            ->leftJoin('t.skills','s')
            ->where('t.id = :id')
            ->setParameter('id',$id);

        return $qb->getQuery()->getOneOrNullResult();

    }
}
