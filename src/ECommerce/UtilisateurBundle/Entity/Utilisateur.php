<?php
// src/AppBundle/Entity/User.php

namespace ECommerce\UtilisateurBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Utilisateur extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\OneToMany(targetEntity="ECommerce\ECommerceBundle\Entity\Commande", mappedBy="utilisateur", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="ECommerce\ECommerceBundle\Entity\Commande", mappedBy="adresse", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     * */
    private $adresse;

    public function __construct()
    {
        parent::__construct();
        $this->commandes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->adresse = new \Doctrine\Common\Collections\ArrayCollection();
    }
}