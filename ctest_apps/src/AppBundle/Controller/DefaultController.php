<?php

namespace AppBundle\Controller;

use AppBundle\Assert\ProductAssert;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use function dump;

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
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
        echo '<h1>Connexion succeed to database </h1>'; 
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
	
	/**
     * @Route("/products/list", name="product_list")
     */
	public function getList(Request $request)
	{
		$products = $this->getDoctrine()->getManager()->getRepository('AppBundle:Product')->findAll();
		
		$data = [];
		foreach ($products as $product) {
			$data[] = $product->toArray();
		}
		
		return $this->json($data);
	}
	
	/**
	 * @Method({"POST"})
     * @Route("/products/add", name="product_add")
     */
	public function add(Request $request)
	{
		$data = json_decode($request->getContent(), true);
		
		$productAssert = new ProductAssert();
		$productAssert->setName($data['name']);
		$productAssert->setPrice($data['price']);
		
		$errors = $this->get('validator')->validate($productAssert);
		
		if(count($errors) > 0) {
			$code = 400;
			$data = []; 
			foreach ($errors as $error) {
				$data[] = $error->getMessage();
			}
		} else {
			$code = 200;
			$product = new \AppBundle\Entity\Product();
			$product->setName($data['name']);			
			$product->setPrice($data['price']);
			
			$this->getDoctrine()->getManager()->persist($product);
			$this->getDoctrine()->getManager()->flush();			
		}
			
		$result = [
			'code'	=> $code,
			'data'	=> $data
		];
		
		return $this->json($result);
	}
}
