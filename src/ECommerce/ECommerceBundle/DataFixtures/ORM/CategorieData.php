<?php

namespace ECommerce\ECommerceBundle\DataFixtures;

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
class CategorieData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        $tab_Categories = array(
            array(
                "nom" => "fruit",
                "description" => "Fruit",
                "media" => $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'fruit')),
            ),

            array(
                "nom" => "legume",
                "description" => "legume",
                "media" => $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'legume')),
            )
        );

        for($i=0; $i< sizeof($tab_Categories); $i++ ){
            $categorie = new Categorie();
            $categorie->setNom($tab_Categories[$i]['nom']);
            $categorie->setDescription($tab_Categories[$i]['description']);
            $categorie->setMedia($tab_Categories[$i]['media']);

            $manager->persist($categorie);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
    
}
