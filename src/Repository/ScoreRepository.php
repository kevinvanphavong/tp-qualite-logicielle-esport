<?php

namespace App\Repository;

use App\Entity\Score;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Score>
 *
 * @method Score|null find($id, $lockMode = null, $lockVersion = null)
 * @method Score|null findOneBy(array $criteria, array $orderBy = null)
 * @method Score[]    findAll()
 * @method Score[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Score::class);
    }

    public function save(Score $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Score $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllWithRanking()
    {
        // select team_id, SUM(total_points) from score where team_id IS NOT NULL group by team_id

        $query = $this->getEntityManager()->createQuery(
            'SELECT s.team, SUM(s.totalPoints) FROM App\Entity\Score s WHERE s.team IS NOT NULL GROUP BY s.team ORDER BY s.totalPoints DESC'
        );
        // select team_id, SUM(total_points) from Score where team_id IS NOT NULL group by team_id ORDER BY SUM(total_points) DESC');
//        $qb = $this->createQueryBuilder('s');
//        $qb->select('s.team, SUM(s.totalPoints)')
//            ->where('s.team IS NOT NULL')
//            ->groupBy('s.team')
//            ->orderBy('s.totalPoints', 'DESC')
        ;

        return $query->getResult();

//        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return Score[] Returns an array of Score objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Score
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
