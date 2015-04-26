<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // pobieramy listę ostatnio dodanych produktów
        $products = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->getLastAdded();
        
        return $this->render('Homepage/index.html.twig', [
            'products' => $products,
        ]);
    }
}
