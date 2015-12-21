<?php
namespace ECommerce\ECommerceBundle\DataFixtures;
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
class ProduitData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        $tab_Produits = array(
            array(
                "nom" => "tomate",
                "description" => "tomate: légumes de couleur rouge",
                "disponible" => true,
                "plage" => "",
                "prix" => "1.87",
                "tva" => "21%",
                "media" =>
                    $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'tomate')),
                "categorie" => $manager->getRepository('ECommerceECommerceBundle:Categorie')->findOneBy(array('nom' => 'legume')
                )
             ),
            array(
                "nom" => "banane",
                "description" => "fruit très bon",
                "disponible" => true,
                "plage" => "",
                "prix" => "1.54",
                "tva" => "21%",
                "media" =>
                    $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'banane')),
                "categorie" => $manager->getRepository('ECommerceECommerceBundle:Categorie')->findOneBy(array('nom' => 'fruit')
                )
            ),
            array(
                "nom" => "carotte",
                "description" => "légumes de couleur orange",
                "disponible" => true,
                "plage" => "",
                "prix" => "0.54",
                "tva" => "21%",
                "media" =>
                    $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'carotte')),
                "categorie" => $manager->getRepository('ECommerceECommerceBundle:Categorie')->findOneBy(array('nom' => 'legume')
                )
            ),
            array(
                "nom" => "poire",
                "description" => "Fruit très juteu",
                "disponible" => true,
                "plage" => "",
                "prix" => "1.07",
                "tva" => "21%",
                "media" =>
                    $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'poire')),
                "categorie" => $manager->getRepository('ECommerceECommerceBundle:Categorie')->findOneBy(array('nom' => 'fruit')
                )
            ),
            array(
                "nom" => "poirreau",
                "description" => "Légume mangé souvent en sauce blanche, très savoureu",
                "disponible" => true,
                "plage" => "",
                "prix" => "1.94",
                "tva" => "21%",
                "media" =>
                    $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'poirreau')),
                "categorie" => $manager->getRepository('ECommerceECommerceBundle:Categorie')->findOneBy(array('nom' => 'legume')
                )
            ),
            array(
                "nom" => "pomme",
                "description" => "un pomme par jour éloigne du médecin",
                "disponible" => true,
                "plage" => "",
                "prix" => "0.34",
                "tva" => "21%",
                "media" =>
                    $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'pomme')),
                "categorie" => $manager->getRepository('ECommerceECommerceBundle:Categorie')->findOneBy(array('nom' => 'fruit')
                )
            ),
            array(
                "nom" => "salade",
                "description" => "légumes souvent préparé avec de la mayohnnaire ou de la vinaigrette",
                "disponible" => true,
                "plage" => "",
                "prix" => "0.14",
                "tva" => "21%",
                "media" =>
                    $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'salade')),
                "categorie" => $manager->getRepository('ECommerceECommerceBundle:Categorie')->findOneBy(array('nom' => 'legume')
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
            $produit->setMedia($tab_Produits[$i]['media']);
            $produit->setCategorie($tab_Produits[$i]['categorie']);

            $manager->persist($produit);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
    
}
