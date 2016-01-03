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

        $list_produits = $this->getDoctrine()->getManager()->getRepository('ECommerceECommerceBundle:Produit')->findAll();
        $form = $this->createForm(new RechercheType());
        $panier = null;

        if($session->has('panier'))
        {
            $panier = $session->get('panier');
        }
        else{
            $panier = array();
        }

        return $this->render('ECommerceECommerceBundle:FrontEnd/Produit:list.html.twig', array(
            'list_produits' => $list_produits,
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

    public function listByCategorieAction(Categorie $categorie)
    {
        $list_produits = $this->getDoctrine()->getManager()->getRepository('ECommerceECommerceBundle:Produit')->byCategorie($categorie);
        $form = $this->createForm(new RechercheType());

        return $this->render('ECommerceECommerceBundle:FrontEnd/Produit:list.html.twig', array(
            'list_produits' => $list_produits,
            'form' => $form->createView()
        ));
    }

    public function readAction(Produit $produit)
    {
        $produit = $this->getDoctrine()->getManager()->getRepository('ECommerceECommerceBundle:Produit')->find($produit->getId());
        $form = $this->createForm(new RechercheType());
        $list_categories = $this->getDoctrine()->getManager()->getRepository('ECommerceECommerceBundle:Categorie')->findAll();

        return $this->render('ECommerceECommerceBundle:FrontEnd/Produit:read.html.twig', array(
            'produit' => $produit,
            'list_categories' => $list_categories,
            'form' => $form->createView()
        ));
    }


}
