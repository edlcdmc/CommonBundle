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
 * @since   2.7
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
		if(is_array($criteria)){
			$i = 1;
			foreach ($criteria as $name => $value){
				if($this->checkName($name) and $value) {
					$name_s = 'b.'.$name;
					$qb->andWhere("$name_s = :val$i");
					$qb->setParameter("val$i", $value);
					$i++;
				}
			}
		}
		if(is_array($sort)){
			foreach ($sort as $name => $value){
				$this->check($qb, $name, $value);
			}
		}
		return $qb->getQuery();
	}

	protected function check(QueryBuilder $qb, $name, $value, $letter = 'b.')
	{
		$value = strtolower($value);
		$testValue = false;
		if($value == 'asc' or $value == 'desc') {
			$testValue = true;
		}
		if($this->checkName($name) and $testValue) {
			$qb->addOrderBy($letter.$name, $value);
			return true;
		}
		return false;
	}

	protected function checkName($name)
	{
		foreach($this->_class->fieldMappings as $key => $object) {
			if($name == $key) {
				return true;
			}
		}
		foreach($this->_class->associationMappings as $key => $object) {
			if($name == $key) {
				return true;
			}
		}
		return false;
	}
}
