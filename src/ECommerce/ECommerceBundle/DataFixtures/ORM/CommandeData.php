<?php

namespace ECommerce\ECommerceBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use ECommerce\ECommerceBundle\Entity\Commande;
use ECommerce\ECommerceBundle\Entity\Produit;
/**
 * Description of Commande
 *
 * @author jHeyvaert
 */
class CommandeData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager){

        $tab_Commande = array(
            array(
                "utilisateur" => $manager->getRepository('ECommerceUtilisateurBundle:Utilisateur')->findOneBy(array('username' => 'benjamin')),
                "valider" => 1,
                "date" => new \DateTime(),
                "reference" => 1,
                "produit" => array(
                    $manager->getRepository('ECommerceECommerceBundle:Produit')->findOneBy(array('nom' => 'salade')),
                    $manager->getRepository('ECommerceECommerceBundle:Produit')->findOneBy(array('nom' => 'tomate')),
                    $manager->getRepository('ECommerceECommerceBundle:Produit')->findOneBy(array('nom' => 'pomme'))
                )
            )
        );

        for($i=0; $i< sizeof($tab_Commande); $i++ ){
            $commande = new Commande();
            $commande->setUtilisateur($tab_Commande[$i]['utilisateur']);
            $commande->setValider($tab_Commande[$i]['valider']);
            $commande->setDate($tab_Commande[$i]['date']);
            $commande->setReference($tab_Commande[$i]['reference']);

            $tab_Produit = $tab_Commande[$i]['produit'];
            for ($j = 0; $j < sizeof($tab_Commande); $j++) {
                $commande->setProduits($tab_Produit[$j]);
            }

            $manager->persist($commande);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }
    
}
