<?php

namespace ECommerce\UtilisateurBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

use ECommerce\UtilisateurBundle\Entity\Utilisateur;
use ECommerce\UtilisateurBundle\Entity\UtilisateurAdresse;

/**
 * Description of Categorie
 *
 * @author jHeyvaert
 */
class UtilisateurAdresseData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager){

        $tab_UtilisateurAdresse = array(
            array(
                "utilisateur" => $manager->getRepository('ECommerceUtilisateurBundle:Utilisateur')->findOneBy(array('username' => 'benjamin')),
                "telephone" => "0600000000",
                "adresse" => "rue albertina rubosca",
                "cp" => "76600",
                "pays" => "France",
                "ville" => "Le Havre",
                "complement" => "face à l'église",
            )

        );

        for($i=0; $i< sizeof($tab_UtilisateurAdresse); $i++ ){
            $adresse = new UtilisateurAdresse();
            $adresse->setUtilisateur($tab_UtilisateurAdresse[$i]['utilisateur']);
            $adresse->setRue($tab_UtilisateurAdresse[$i]['adresse']);
            $adresse->setCp($tab_UtilisateurAdresse[$i]['cp']);
            $adresse->setPays($tab_UtilisateurAdresse[$i]['pays']);
            $adresse->setVille($tab_UtilisateurAdresse[$i]['ville']);
            $adresse->setComplement($tab_UtilisateurAdresse[$i]['complement']);
            $manager->persist($adresse);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
    
}
