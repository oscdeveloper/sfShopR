<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Product;
use AppBundle\Form\BasketForm;

class BasketController extends Controller
{
    /**
     * @Route("/koszyk", name="basket")
     * @Template()
     */
    public function indexAction(Request $request)
    {
//        $products = $this->get('basket')->getProducts();
//
//        $form = $this->createForm(new BasketForm());
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//        }
        
        return array(
            'basket' => $this->get('basket'),
            //'form' => $form->createView(),
        );
    }

    /**
     * @Route("/koszyk/{id}/dodaj", name="basket_add")
     */
    public function addAction(Product $product = null)
    {
        if (is_null($product)) {
            $this->addFlash('notice', 'Produkt, który próbujesz dodać nie został znaleziony!');
            return $this->redirectToRoute('products_list');
        }
        
        $basket = $this->get('basket');
        $basket->add($product);

        $this->addFlash('notice', sprintf('Produkt "%s" został dodany do koszyka', $product->getName()));

        return $this->redirectToRoute('basket');
    }

    /**
     * @Route("/koszyk/{id}/usun", name="basket_remove")
     */
    public function removeAction(Product $product)
    {
        $basket = $this->get('basket');

        try {
            $basket->remove($product);

            //$this->addFlash('notice', 'Produkt ' . $product->getName() . ' został usunięty z koszyka');
            $this->addFlash('notice', sprintf('Product %s został usunięty z koszyka', $product->getName()));

        } catch (\Exception $ex) {

            $this->addFlash('notice', $ex->getMessage());
        }

        return $this->redirectToRoute('basket');
    }

    /**
     * @Route("/koszyk/{id}/zaktualizuj-ilosc/{quantity}")
     * @Template()
     */
    public function updateAction($id, $quantity)
    {




        return array(
                // ...
            );
    }

    /**
     * @Route("/koszyk/wyczysc", name="basket_clear")
     */
    public function clearAction()
    {
        $this
            ->get('basket')
            ->clear();

        $this->addFlash('notice', 'Koszyk został pomyślnie wyczyszczony.');

        return $this->redirectToRoute('basket');
    }

    /**
     * @Route("/koszyk/kup")
     * @Template()
     */
    public function buyAction()
    {
        return array(
                // ...
            );
    }

}
