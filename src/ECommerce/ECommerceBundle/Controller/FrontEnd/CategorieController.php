<?php

namespace ECommerce\ECommerceBundle\Controller\FrontEnd;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ECommerce\ECommerceBundle\Entity\Categorie;

class CategorieController extends Controller
{
    public function listAction()
    {
        $list_categories = $this->getDoctrine()->getManager()->getRepository('ECommerceECommerceBundle:Categorie')->findAll();

        return $this->render('ECommerceECommerceBundle:FrontEnd/Categorie:list.html.twig', array(
            'list_categories' => $list_categories
        ));
    }
}
