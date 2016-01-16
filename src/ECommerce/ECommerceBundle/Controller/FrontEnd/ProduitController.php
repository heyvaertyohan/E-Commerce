<?php

namespace ECommerce\ECommerceBundle\Controller\FrontEnd;

use ECommerce\ECommerceBundle\Entity\Produit;
use ECommerce\ECommerceBundle\Entity\Categorie;
use ECommerce\ECommerceBundle\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{
    public function listAction()
    {
        $session = $this->getRequest()->getSession();
        $panier = $session->get('panier');

        $list_produits = $this->getDoctrine()->getManager()->getRepository('ECommerceECommerceBundle:Produit')->findAll();
        $form = $this->createForm(new RechercheType());

        $list_produits = $this->get('knp_paginator')->paginate($list_produits,$this->get('request')->query->get('page', 1),3);

        return $this->render('ECommerceECommerceBundle:FrontEnd/Produit:list.html.twig', array(
            'list_produits' => $list_produits,
            'form' => $form->createView(),
            'panier' => $panier
        ));
    }

    public function listByCategorieAction(Categorie $categorie)
    {
        $session = $this->getRequest()->getSession();
        $panier = $session->get('panier');

        $list_produits = $this->getDoctrine()->getManager()->getRepository('ECommerceECommerceBundle:Produit')->byCategorie($categorie);
        $list_produits = $this->get('knp_paginator')->paginate($list_produits,$this->get('request')->query->get('page', 1),3);
        $form = $this->createForm(new RechercheType());

        return $this->render('ECommerceECommerceBundle:FrontEnd/Produit:list.html.twig', array(
            'list_produits' => $list_produits,
            'form' => $form->createView(),
            'panier' => $panier
        ));
    }

    public function readAction(Produit $produit)
    {
        $session = $this->getRequest()->getSession();
        $panier = $session->get('panier');

        $produit = $this->getDoctrine()->getManager()->getRepository('ECommerceECommerceBundle:Produit')->find($produit->getId());

        $form = $this->createForm(new RechercheType());

        return $this->render('ECommerceECommerceBundle:FrontEnd/Produit:read.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
            'panier' => $panier
        ));
    }

    public function rechercheAction()
    {
        $form = $this->createForm(new RechercheType());

        if ($this->get('request')->getMethod() == 'POST') {
            $form->bind($this->get('request'));
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository('ECommerceECommerceBundle:Produit')->recherche($form['recherche']->getData());
        } else {
            throw $this->createNotFoundException('La page n\'existe pas.');
        }

        return $this->render('ECommerceECommerceBundle:FrontEnd/Produit:list.html.twig', array(
            'list_produits' => $produits,
            'form' => $form->createView()
        ));
    }

}
