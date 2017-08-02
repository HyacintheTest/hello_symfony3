<?php

namespace AppBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
	public function getByNameLike($name)
	{
		return $this->createQueryBuilder('u')
			->where('u.firstName LIKE :name')
			->orWhere('u.lastName LIKE :name')
			->setParameter('name', '%'.$name.'%')
			->getQuery()
			->getResult();
	}
	
	public function createQueryBuilderGetAll() {
		return $this->createQueryBuilder('u');
	}
}
