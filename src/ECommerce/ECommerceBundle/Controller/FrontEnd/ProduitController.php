<?php

namespace ECommerce\ECommerceBundle\Controller\FrontEnd;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{
    public function indexAction()
    {
        return $this->render('ECommerceECommerceBundle:FrontEnd/Produit:index.html.twig');
    }

}
