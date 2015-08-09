<?php
namespace Edlcdmc\Bundle\CommonBundle\Doctrine\ORM;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

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
	 * @param $criteria
	 * @param $sort
	 * @return \Doctrine\ORM\Query
	 */
	public function findByMyCriteriaDQL($criteria, $sort) {
		$qb = $this->createQueryBuilder('b')
			->select('b');
		// 		->leftJoin('b.parent', 'c')
		// 		->where('b.active = 1' );
		if(is_array($criteria)){
			foreach ($criteria as $name => $value){
				$name = mysql_real_escape_string($name);
				$value = mysql_real_escape_string($value);
				$name_s = 'b.'.$name;
				$qb->andWhere("$name_s = $value");
			}
		}
//    	if(is_array($sort)){
//    		foreach ($sort as $name => $value){
//    			$qb->addOrderBy('b.'.$name, $value);
//    		}
//    	}
		if(is_array($sort)){
			foreach ($sort as $name => $value){
				$this->check($qb, $name, $value);
			}
		}
		//	echo $qb->getDql();
		//	->addOrderBy('b.createdAt', 'ASC');
//    		$a = $qb->getDql();
//    		echo $a;
		return $qb->getQuery();
	}

	protected function check(QueryBuilder $qb, $name, $value, $letter = 'b.')
	{
		$name = mysql_real_escape_string($name);
		$value = mysql_real_escape_string($value);
		$value = strtolower($value);
		$testName = false; $testValue = false;
		foreach($this->_class->fieldMappings as $key => $object) {
			if($name == $key) {
				$testName = true;
			}
		}
		if($value == 'asc' or $value == 'desc') {
			$testValue = true;
		}
		if($testName and $testValue) {
			$qb->addOrderBy($letter.$name, $value);
			return true;
		}
		return false;
	}
}
