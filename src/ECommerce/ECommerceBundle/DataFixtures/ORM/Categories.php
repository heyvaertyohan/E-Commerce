<?php
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ECommerce\ECommerceBundle\Entity\Categorie;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
/**
 * Description of Categorie
 *
 * @author jHeyvaert
 */
class Categories extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        $tab_Categories = array(
            array(
                "nom" => "fruits",
                "description" => "Categorie fruits",
            ),
            array(
                "nom" => "legumes",
                "description" => "Categorie légumes",
            )
        );

        for($i=0; $i< sizeof($tab_Categories); $i++ ){
            $categorie = new Categorie();
            $categorie->setNom($tab_Categories[$i]['nom']);
            $categorie->setDescription($tab_Categories[$i]['description']);

            $manager->persist($categorie);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
    
}
