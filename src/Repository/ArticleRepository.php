<?php
namespace App\Repository;
use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }
    public function search( $term ){
        $stmt = $this->createQueryBuilder('e');
        $stmt->where( 'e.name LIKE :term' );
        $stmt->setParameter( ':term', '%' . $term . '%' );
        return $stmt->getQuery()->getResult();
    }
}

   
