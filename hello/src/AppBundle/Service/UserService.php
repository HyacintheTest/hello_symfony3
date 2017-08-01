<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class UserService{
	
	/**
	 *
	 * @var EntityManager
	 */
	private $em;
	
	/**
	 * 
	 * @param EntityManager $em
	 */
	function __construct(EntityManager $em) {
		$this->em = $em;
	}
	
	/**
	 * 
	 * @param User $user
	 * @return User
	 */
	public function save(User $user) {
		$this->em->persist($user);
		$this->em->flush();
		
		return $user;
	}
}
