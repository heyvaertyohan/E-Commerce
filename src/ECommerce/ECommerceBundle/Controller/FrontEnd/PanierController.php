<?php

namespace ECommerce\ECommerceBundle\Controller\FrontEnd;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PanierController extends Controller
{
    public function indexAction()
    {
        return $this->render('ECommerceECommerceBundle:FrontEnd/Panier:index.html.twig');
    }

    public function livraisonAction()
    {
        return $this->render('ECommerceECommerceBundle:FrontEnd/Panier:livraison.html.twig');
    }

    public function validationAction()
    {
        return $this->render('ECommerceECommerceBundle:FrontEnd/Panier:validation.html.twig');
    }
}
