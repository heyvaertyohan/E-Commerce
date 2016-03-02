<?php

namespace ECommerce\UtilisateurBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use ECommerce\UtilisateurBundle\Entity\Utilisateur;
/**
 * Description of Categorie
 *
 * @author jHeyvaert
 */
class UtilisateursData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager){

        $tab_Utilisateur = array(
            array(
                "username" => "benjamin",
                "nom" => "benjamin",
                "prenom" => "benjamin",
                "email" => "benjamin@gmail.com",
                "telephone" => "0484123456",
                "enabled" => 1,
                "password" => 'testpwd',
                "media" => $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'user')),
            ),
            array(
                "username" => "mathilde",
                "nom" => "mathilde",
                "prenom" => "mathilde",
                "email" => "mathilde@gmail.com",
                "telephone" => "0484123456",
                "enabled" => 1,
                "password" => 'mathilde',
                "media" => $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'user')),
            ),
            array(
                "username" => "pauline",
                "nom" => "pauline",
                "prenom" => "pauline",
                "email" => "pauline@gmail.com",
                "telephone" => "0484123456",
                "enabled" => 1,
                "password" => 'testpwd',
                "media" => $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'user')),
            ),
            array(
                "username" => "dominique",
                "nom" => "dominique",
                "prenom" => "dominique",
                "email" => "dominique@gmail.com",
                "telephone" => "0484123456",
                "enabled" => 1,
                "password" => 'testpwd',
                "media" => $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'user')),
            ),
            array(
                "username" => "yohan",
                "nom" => "yohan",
                "prenom" => "yohan",
                "email" => "heyvaertyohan@gmail.com",
                "telephone" => "0484123456",
                "enabled" => 1,
                "password" => 'yohan',
                "media" => $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'user')),
            )
        );

        for($i=0; $i< sizeof($tab_Utilisateur); $i++ ){
            $utilisateur = new Utilisateur();
            $utilisateur->setUsername($tab_Utilisateur[$i]['username']);
            $utilisateur->setNom($tab_Utilisateur[$i]['nom']);
            $utilisateur->setPrenom($tab_Utilisateur[$i]['prenom']);
            $utilisateur->setEmail($tab_Utilisateur[$i]['email']);
            $utilisateur->setEnabled($tab_Utilisateur[$i]['enabled']);
            $utilisateur->setTelephone($tab_Utilisateur[$i]['telephone']);
            $utilisateur->setPassword($this->container->get('security.encoder_factory')->getEncoder($utilisateur)->encodePassword($tab_Utilisateur[$i]['password'], $utilisateur->getSalt()));

            $manager->persist($utilisateur);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
    
}
