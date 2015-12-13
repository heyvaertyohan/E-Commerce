<?php
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ECommerce\ECommerceBundle\Entity\Produit;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
/**
 * Description of Produit
 *
 * @author jHeyvaert
 */
class Produits extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        $tab_Produits = array(
            array(
                "nom" => "tomage",
                "description" => "tomate qui se mange",
                "disponible" => true,
                "plage" => "",
                "prix" => "0.87",
                "tva" => "21%",
                "image" =>
                    $manager->getRepository('ECommerceECommerceBundle:Image')->findOneBy(array('nom' => 'tomate')),
                "categorie" => array(
                    $manager->getRepository('ECommerceECommerceBundle:Categorie')->findOneBy(array('nom' => 'legumes'))
                )
             )
        );

        for($i=0; $i< sizeof($tab_Produits); $i++ ){
            $produit = new Produit();
            $produit->setNom($tab_Produits[$i]['nom']);
            $produit->setDescription($tab_Produits[$i]['description']);
            $produit->setDisponible($tab_Produits[$i]['disponible']);
            $produit->setPlage($tab_Produits[$i]['plage']);
            $produit->setPrix($tab_Produits[$i]['prix']);
            $produit->setTva($tab_Produits[$i]['tva']);
            $produit->setImage($tab_Produits[$i]['image']);

            $tab_Categ = $tab_Produits[$i]['categorie'];
            for ($j = 0; $j < sizeof($tab_Categ); $j++) {
                $produit->addCategorie($tab_Categ[$j]);
            }

            $manager->persist($produit);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
    
}
