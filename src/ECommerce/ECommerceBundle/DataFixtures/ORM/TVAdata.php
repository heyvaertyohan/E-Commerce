<?php
namespace ECommerce\ECommerceBundle\DataFixtures;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ECommerce\ECommerceBundle\Entity\Tva;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
/**
 * Description of Categorie
 *
 * @author jHeyvaert
 */
class TVAData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        $tab_TVA = array(
            array(
                "multiplicate" => "0.7777",
                "nom" => "TVA 21%",
                "valeur" => "1.21",
            ),
            array(
                "multiplicate" => "0.7777",
                "nom" => "TVA 12%",
                "valeur" => "1.12"
            )
        );

        for($i=0; $i< sizeof($tab_TVA); $i++ ){
            $tva = new Tva();
            $tva->setMultiplicate($tab_TVA[$i]["multiplicate"]);
            $tva->setNom($tab_TVA[$i]["nom"]);
            $tva->setValeur($tab_TVA[$i]["valeur"]);

            $manager->persist($tva);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
    
}
