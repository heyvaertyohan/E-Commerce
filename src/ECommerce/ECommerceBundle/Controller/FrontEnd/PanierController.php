<?php

namespace ECommerce\ECommerceBundle\Controller\FrontEnd;

use ECommerce\UtilisateurBundle\ECommerceUtilisateurBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ECommerce\ECommerceBundle\Form\RechercheType;
use Symfony\Component\HttpFoundation\RedirectResponse;

use ECommerce\ECommerceBundle\Entity\Produit;
use ECommerce\UtilisateurBundle\Entity\UtilisateurAdresse;
use Ecommerce\EcommerceBundle\Form\UtilisateursAdressesType;

class PanierController extends Controller
{
    public function menuAction()
    {
        $session = $this->getRequest()->getSession();
        if (!$session->has('panier'))
            $articles = 0;
        else
            $articles = count($session->get('panier'));

        return $this->render('ECommerceECommerceBundle:FrontEnd/Panier:menu.html.twig', array('articles' => $articles));
    }

    public function listAction()
    {
        $session = $this->getRequest()->getSession();
        if (!$session->has('panier')) $session->set('panier', array());

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('ECommerceECommerceBundle:Produit')->findArray(array_keys($session->get('panier')));

        return $this->render('ECommerceECommerceBundle:FrontEnd/Panier:list.html.twig', array('list_produits' => $produits,
            'panier' => $session->get('panier')));
    }

    public function validationAction()
    {
        return $this->render('ECommerceECommerceBundle:FrontEnd/Panier:validation.html.twig');
    }

    public function supprimerAction(Produit $produit)
    {
        $session = $this->getRequest()->getSession();
        $panier = $session->get('panier');

        if(array_key_exists($produit->getId(), $panier)){
            unset($panier[$produit->getId()]);
            $session->set('panier', $panier);
            $this->get('session')->getFlashBag('success', "l'article a bien été supprimé" );
        }

        return $this->redirect($this->generateUrl('e_commerce_panier'));
    }

    public function supprimer2Action($id)
    {
        $session = $this->getRequest()->getSession();
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier))
        {
            unset($panier[$id]);
            $session->set('panier',$panier);
            $this->get('session')->getFlashBag()->add('success','Article supprimé avec succès');
        }

        return $this->redirect($this->generateUrl('panier'));
    }

    public function ajouterAction(Produit $produit)
    {
        $session = $this->getRequest()->getSession();

        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');

        if (array_key_exists($produit->getId(), $panier)) {
            if ($this->getRequest()->query->get('qte') != null) {
                $panier[$produit->getId()] = $this->getRequest()->query->get('qte');
            }
            $this->get('session')->getFlashBag()->add('success','Quantité modifié avec succès');
        } else {
            if ($this->getRequest()->query->get('qte') != null)
                $panier[$produit->getId()] = $this->getRequest()->query->get('qte');
            else
                $panier[$produit->getId()] = 1;

            $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
        }

        $session->set('panier',$panier);

        return $this->redirect($this->generateUrl('e_commerce_panier'));
    }

    public function livraisonvalidationAction()
    {
        $utilisateur = $this->container->get('security.context')->getToken()->getUser();
        $entity = new UtilisateurAdresse();
        $form = $this->createForm(new UtilisateursAdressesType(), $entity);

        if ($this->get('request')->getMethod() == 'POST')
        {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity->setUtilisateur($utilisateur);
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('livraison'));
            }
        }

        return $this->render('EcommerceBundle:Default:panier/layout/livraison.html.twig', array('utilisateur' => $utilisateur,
            'form' => $form->createView()));
    }

}
