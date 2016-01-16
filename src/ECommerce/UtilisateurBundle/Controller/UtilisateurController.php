<?php

namespace ECommerce\UtilisateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UtilisateurController extends Controller
{
    public function menuAction()
    {
        return $this->render('ECommerceUtilisateurBundle:Utilisateur:menu.html.twig');
    }
}
