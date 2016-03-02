<?php

namespace ECommerce\UtilisateurBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use ECommerce\PageBundle\Entity\Page;
/**
 * Description of Page
 *
 * @author jHeyvaert
 */
class PagesData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager){

        $tab_Pages = array(
            array(
                "titre" => "CGV",
                "contenu" => '<div class="row">
                <h4>Item Brand and Category</h4>
                <h5>AB29837 Item Model</h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>' ),

            array(
                "titre" => "Mentions légales",
                "contenu" => '<div class="row">
                <h4>Item Brand and Category</h4>
                <h5>AB29837 Item Model</h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>')
        );

        for($i=0; $i< sizeof($tab_Pages); $i++ ){
            $page = new Page();
            $page->setTitre($tab_Pages[$i]['titre']);
            $page->setContenu($tab_Pages[$i]['contenu']);
            $manager->persist($page);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 8;
    }
    
}
