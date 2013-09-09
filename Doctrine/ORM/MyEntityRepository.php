<?php
namespace Edlcdmc\Bundle\CommonBundle\Doctrine\ORM;

use Doctrine\ORM\EntityRepository;

/**
 * An EntityRepository serves as a repository for entities with generic as well as
 * business specific methods for retrieving entities.
 *
 * This class is designed for inheritance and users can subclass this class to
 * write their own repositories with business-specific methods to locate entities.
 *
 * @since   2.1
 * @author  Kamil Filipiak <edlcdmc@gmail.com>
 */
class MyEntityRepository extends EntityRepository
{
    
    /**
     * Funkcja do wyszukujaca elementy dla dzielenia na strony wyniku
     *
     * @param unknown_type $criteria
     * @param unknown_type $sort
     */
    public function findByMyCriteriaDQL($criteria, $sort) {
    	$qb = $this->createQueryBuilder('b')
    	->select('b');
    	// 		->leftJoin('b.parent', 'c')
    	// 		->where('b.active = 1' );
    	if(is_array($criteria)){
    		foreach ($criteria as $name => $value){
    			$name_s = 'b.'.$name;
    			$qb->andWhere("$name_s = $value");
    		}
    	}
    	if(is_array($sort)){
    		foreach ($sort as $name => $value){
    			$qb->addOrderBy('b.'.$name, $value);
    		}
    	}
    	//	echo $qb->getDql();
    	//	->addOrderBy('b.createdAt', 'ASC');
//    		$a = $qb->getDql();
//    		echo $a;
    	return $qb->getQuery();
    }
}
