<?php

namespace ECommerce\ECommerceBundle\Controller\FrontEnd;

use ECommerce\UtilisateurBundle\ECommerceUtilisateurBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ECommerce\ECommerceBundle\Form\RechercheType;
use Symfony\Component\HttpFoundation\RedirectResponse;

use ECommerce\ECommerceBundle\Entity\Produit;
use ECommerce\UtilisateurBundle\Entity;
use ECommerce\UtilisateurBundle\Form;

class CommandeController extends Controller
{
    public function validationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('EcommerceBundle:Commandes')->find($id);

        if (!$commande || $commande->getValider() == 1)
            throw $this->createNotFoundException('La commande n\'existe pas');

        $commande->setValider(1);
        $commande->setReference($this->container->get('setNewReference')->reference()); //Service
        $em->flush();

        $session = $this->getRequest()->getSession();
        $session->remove('adresse');
        $session->remove('panier');
        $session->remove('commande');

        $this->get('session')->getFlashBag()->add('success','Votre commande est validé avec succès');
        return $this->redirect($this->generateUrl('factures'));
    }

    public function prepareCommandeAction()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();

        if (!$session->has('commande'))
            $commande = new Commandes();
        else
            $commande = $em->getRepository('ECommerceBundle:Commande')->find($session->get('commande'));

        $commande->setDate(new \DateTime());
        $commande->setUtilisateur($this->container->get('security.context')->getToken()->getUser());
        $commande->setValider(0);
        $commande->setReference(0);
        $commande->setCommande($this->facture());

        if (!$session->has('commande')) {
            $em->persist($commande);
            $session->set('commande',$commande);
        }

        $em->flush();

        return new Response($commande->getId());
    }

}
