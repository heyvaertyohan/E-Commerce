<?php
namespace ECommerce\ECommerceBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ECommerce\ECommerceBundle\Entity\Media;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
/**
 * Description of Media
 *
 * @author jHeyvaert
 */
class MediaData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        $tab_Medias = array(
            array(
                "nom" => "tomate",
                "description" => "image tomate",
                "path" => "bundles/ecommerceecommerce/images/tomate.jpg",
            ),
            array(
                "nom" => "banane",
                "description" => "image banane",
                "path" => "bundles/ecommerceecommerce/images/banane.png",
            ),
            array(
                "nom" => "carotte",
                "description" => "image carotte",
                "path" => "bundles/ecommerceecommerce/images/carotte.jpg",
            ),
            array(
                "nom" => "poire",
                "description" => "image poire",
                "path" => "bundles/ecommerceecommerce/images/poire.jpg",
            ),
            array(
                "nom" => "poirreau",
                "description" => "image poirreau",
                "path" => "bundles/ecommerceecommerce/images/poirreau.jpg",
            ),
            array(
                "nom" => "pomme",
                "description" => "image pomme",
                "path" => "bundles/ecommerceecommerce/images/pomme.jpg",
            ),
            array(
                "nom" => "salade",
                "description" => "image salade",
                "path" => "bundles/ecommerceecommerce/images/salade.jpg",
            ),
            array(
                "nom" => "fruit",
                "description" => "image fruit",
                "path" => "bundles/ecommerceecommerce/images/fruit.jpg",
            ),
            array(
                "nom" => "legume",
                "description" => "image legume",
                "path" => "bundles/ecommerceecommerce/images/legume.jpg",
            ),
            array(
                "nom" => "user",
                "description" => "image user",
                "path" => "bundles/ecommerceecommerce/images/user.png",
            )
        );

        for($i=0; $i< sizeof($tab_Medias); $i++ ){
            $image = new Media();
            $image->setNom($tab_Medias[$i]['nom']);
            $image->setDescription($tab_Medias[$i]['description']);
            $image->setPath($tab_Medias[$i]['path']);

            $manager->persist($image);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
    
}
