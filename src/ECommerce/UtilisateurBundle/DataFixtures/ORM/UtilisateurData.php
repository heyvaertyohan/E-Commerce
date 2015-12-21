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
                "email" => "benjamin@gmail.com",
                "enabled" => 1,
                "password" => 'testpwd',
                "media" => $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'user')),
            ),
            array(
                "username" => "mathilde",
                "email" => "mathilde@gmail.com",
                "enabled" => 1,
                "password" => 'mathilde',
                "media" => $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'user')),
            ),
            array(
                "username" => "pauline",
                "email" => "pauline@gmail.com",
                "enabled" => 1,
                "password" => 'testpwd',
                "media" => $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'user')),
            ),
            array(
                "username" => "dominique",
                "email" => "dominique@gmail.com",
                "enabled" => 1,
                "password" => 'testpwd',
                "media" => $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'user')),
            ),
            array(
                "username" => "yohan",
                "email" => "heyvaertyohan@gmail.com",
                "enabled" => 1,
                "password" => 'testpwd',
                "media" => $manager->getRepository('ECommerceECommerceBundle:Media')->findOneBy(array('nom' => 'user')),
            )
        );

        for($i=0; $i< sizeof($tab_Utilisateur); $i++ ){
            $utilisateur = new Utilisateur();
            $utilisateur->setUsername($tab_Utilisateur[$i]['username']);
            $utilisateur->setEmail($tab_Utilisateur[$i]['email']);
            $utilisateur->setEnabled($tab_Utilisateur[$i]['enabled']);
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
