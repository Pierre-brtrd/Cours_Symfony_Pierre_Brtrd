<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private PaginatorInterface $paginator
    ) {
        parent::__construct($registry, Article::class);
    }

    public function add(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function createQueryListActiveArticle()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.active = :val')
            ->setParameter('val', true)
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery();
    }

    public function findLatestArticleWithLimit(int $limit)
    {
        return $this->createQueryBuilder('a')
            ->select('a', 'u', 'i')
            ->join('a.user', 'u')
            ->leftJoin('a.articleImages', 'i')
            ->andWhere('a.active = :active')
            ->setParameter('active', true)
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findSearch(SearchData $search, bool $active = true): PaginationInterface
    {
        $query = $this->createQueryBuilder('a')
            ->select('a', 'c', 'u', 'i', 'co')
            ->leftJoin('a.categories', 'c')
            ->leftJoin('a.comments', 'co')
            ->Join('a.user', 'u')
            ->leftJoin('a.articleImages', 'i');

        if ($active) {
            $query->andWhere('a.active = true');
        } else {
            if (!empty($search->getActive())) {
                $query->andWhere('a.active IN (:active)')
                    ->setParameter('active', $search->getActive());
            }
        }

        if (!empty($search->getQuery())) {
            $query = $query->andWhere('a.titre LIKE :titre')
                ->setParameter('titre', "%{$search->getQuery()}%");
        }

        if (!empty($search->getCategories())) {
            $query = $query->andWhere('c.id IN (:categories)')
                ->setParameter('categories', $search->getCategories());
        }

        $query = $query->getQuery();

        return $this->paginator->paginate(
            $query,
            $search->getPage(),
            6
        );
    }

    //    /**
    //     * @return Article[] Returns an array of Article objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Article
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
