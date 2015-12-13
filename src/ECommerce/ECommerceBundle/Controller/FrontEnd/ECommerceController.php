<?php

namespace ECommerce\ECommerceBundle\Controller\FrontEnd;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ECommerceController extends Controller
{
    public function indexAction()
    {
        return $this->render('ECommerceECommerceBundle:FrontEnd/ECommerce:index.html.twig');
    }

}
