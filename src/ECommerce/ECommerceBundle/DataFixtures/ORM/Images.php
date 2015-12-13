<?php
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ECommerce\ECommerceBundle\Entity\Image;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
/**
 * Description of Image
 *
 * @author jHeyvaert
 */
class Images extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        $tab_Images = array(
            array(
                "nom" => "tomate",
                "description" => "image tomate",
                "path" => "bundles/ecommerceecommerce/images/tomate.jpg",
            )
        );

        for($i=0; $i< sizeof($tab_Images); $i++ ){
            $image = new Image();
            $image->setNom($tab_Images[$i]['nom']);
            $image->setDescription($tab_Images[$i]['description']);
            $image->setPath($tab_Images[$i]['path']);

            $manager->persist($image);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
    
}
