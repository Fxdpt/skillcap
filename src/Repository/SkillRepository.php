<?php

namespace App\Repository;

use App\Entity\Skill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Skill|null find($id, $lockMode = null, $lockVersion = null)
 * @method Skill|null findOneBy(array $criteria, array $orderBy = null)
 * @method Skill[]    findAll()
 * @method Skill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Skill::class);
    }

    public function getAllSkillsWithData()
    {
        $queryBuilder = $this->createQueryBuilder('s')
            ->select('s','t','c')
            ->leftJoin('s.type','t')
            ->leftJoin('s.categories','c');
        $results = $queryBuilder->getQuery()->getResult();
        
        return $results;
    }

    public function getOneSkillWithData($id)
    {
        $queryBuilder = $this->createQueryBuilder('s')
            ->select('s','t','ta','c')
            ->leftJoin('s.type','t')
            ->leftJoin('s.tasks','ta')
            ->leftJoin('s.categories','c')
            ->where('s.id = :id')
            ->setParameter('id',$id);

        return $queryBuilder->getQuery()->getSingleResult();
    }

}
