<?php

namespace ECommerce\UtilisateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ECommerceUtilisateurBundle:Default:index.html.twig', array('name' => $name));
    }
}
