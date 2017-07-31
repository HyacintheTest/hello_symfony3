<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
         //phpinfo();


        $entityManager = $em = $this->getDoctrine()->getManager();
        try {
            $entityManager->getConnection()->connect();
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }
        echo '<h1>Connexion succeed to database </h1>'; 
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}
