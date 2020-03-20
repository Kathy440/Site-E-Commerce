<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\ArticleSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }


    /**
     * @return ArticleSearch
     */
    public function findAllVisibleQuery(ArticleSearch $search): array
    {
        /*$query = $this->findVisibleQuery();

        if ($search->getCategorie()) {
            $query = $query
            ->where('a.categorie = :categorie')
            ->setParameter('categorie', $search->getCategorieType());
        }

        if ($search->getMaxPrix()) {
            $query = $query
                ->where('a.prix <= :categorie')
                ->setParameter('maxprix', $search->getMaxPrix());
        }
        return $query->getQuery();*/
        return $this->createQueryBuilder('a')
            ->andWhere('a.categorie = :categorie')
            ->setParameter('categorie', $search->getCategorie())
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return ArticleSearch
     */
    public function findColorQuery(ArticleSearch $search): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.couleur = :couleur')
            ->setParameter('couleur', $search->getCouleur())
            ->getQuery()
            ->getResult()
            ;
    }


    /**
     * @param ArticleSearch $search
     * @return Query
     */
    public function findAllVisible(ArticleSearch $search): Query
    {
        $query = $this->findVisibleQuery();

        if($search->getCategorie()){
            $query = $query
                ->where('a.categorie == :categorie')
            ->setParameter('categorie', $search->getCategorie());
        }
        return  $query->getQuery();
        //->getResult();
    }

    /**
     * @return Article[]
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    
    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->where('a.sold = false');
    }




    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
