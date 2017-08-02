<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Assert;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of ProductAssert
 *
 * @author hyacinthe
 */
class ProductAssert {
	
	
    private $id;

    /**
     * @Assert\NotBlank(
	 *		message="The name should not be blank"
	 * )
     */
    private $name;

    /**
     * @Assert\NotBlank(
	 *		message="The price should not be blank"
	 * )
	 * @Assert\GreaterThan(
	 *		value=0,
	 *		message="The price should be greater than 0"
	 * )
     */
    private $price;
	
	function getId() {
		return $this->id;
	}

	function getName() {
		return $this->name;
	}

	function getPrice() {
		return $this->price;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setName($name) {
		$this->name = $name;
	}

	function setPrice($price) {
		$this->price = $price;
	}
}
