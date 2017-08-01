<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/list", name="user_list")
     */
    public function listAction(Request $request)
    {
		$manager = $this->getDoctrine()->getManager();
		$users = $manager->getRepository('AppBundle:User')->findAll();
		
		$key = 'symfony.message';
		$usersNumber = 0;
		dump($this->get('translator')->trans($key));
		dump($this->get('translator')->transChoice('users.number', $usersNumber));
		
        return $this->render('AppBundle:User:list.html.twig', array(
            'users' => $users,
			'key' => $key
        ));
    }

    /**
     * @Route("/read/{id}", name="user_read", requirements={"id" = "\d+"})
     */
    public function readAction($id)
    {
		$manager = $this->getDoctrine()->getManager();
		$user = $manager->getRepository('AppBundle:User')->find($id);
		
        return $this->render('AppBundle:User:read.html.twig', array(
            'user' => $user
        ));
    }

    /**
     * @Route("/add", name="user_add")
     */
    public function addAction(Request $request)
    {
		$user = new User();
		
		$form = $this->createForm(UserType::class, $user);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid()) {			
			$this->get('ct.services.user')->save($user);
			$this->addFlash('success', 'User saved');
			return $this->redirectToRoute('user_list');
		}
        return $this->render('AppBundle:User:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/find/{name}", name="user_find")
     */
    public function findAction($name)
    {
		$manager = $this->getDoctrine()->getManager();
		$users = $manager->getRepository('AppBundle:User')->getByNameLike($name);
        return $this->render('AppBundle:User:find.html.twig', array(
			'name' => $name,
            'users' => $users
        ));
    }
}
