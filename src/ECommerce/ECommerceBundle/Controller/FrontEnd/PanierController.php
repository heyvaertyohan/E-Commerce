<?php

namespace ECommerce\ECommerceBundle\Controller\FrontEnd;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ECommerce\ECommerceBundle\Form\RechercheType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PanierController extends Controller
{
    public function listAction()
    {
        $session = $this->getRequest()->getSession();

        $list_produits = $this->getDoctrine()->getManager()->getRepository('ECommerceECommerceBundle:Produit')->findAll();
        $form = $this->createForm(new RechercheType());
        $panier = null;

        if ($session->has('panier')){
            $panier = $session->get('panier');
        }
        else{
            $panier = array();
        }


        return $this->render('ECommerceECommerceBundle:FrontEnd/Panier:list.html.twig', array(
            'list_produits' => $list_produits,
            'form' => $form->createView(),
            'panier' => $panier
        ));
    }

    public function livraisonAction()
    {
        return $this->render('ECommerceECommerceBundle:FrontEnd/Panier:livraison.html.twig');
    }

    public function validationAction()
    {
        return $this->render('ECommerceECommerceBundle:FrontEnd/Panier:validation.html.twig');
    }

    public function supprimerAction($id)
    {
        $session = $this->getRequest()->getSession();
        $panier = $session->get('panier');

        if(array_key_exists($id, $panier)){
            unset($panier[$id]);
            $session->set($panier);

            $this->get('session')->getFlashBag('success', "l'article a bien été supprimé" );
        }

        return $this->redirect('e_commerce_panier');
    }

    public function ajouterAction($id)
    {
        $session = $this->getRequest()->getSession();

        if(!$session->has(('panier'))) $panier->set('panier', array());

        $panier = $session->get('panier');

        if(array_key_exists($id, $panier)){
            if($this->getRequest()->query->get('qte') != NULL ){
                $panier[$id] = $this->getRequest()->query->set('qte');
                $this->get('session')->getFlashBag('success', 'la quantitée a bien été modifiée');
            }
        }

        return $this->redirect('e_commerce_panier');
    }
}
