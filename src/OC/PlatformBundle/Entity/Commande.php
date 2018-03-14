<?php

namespace OC\PlatformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

   /**
    * @ORM\OneToMany(targetEntity="OC\PlatformBundle\Entity\CommandeProduit", cascade={"persist"}, mappedBy = "commande")
     */
    private $commandeproduits;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;
  
    /**
    * @ORM\ManyToOne(targetEntity="OC\UserBundle\Entity\User", cascade={"persist"})
     */
    private $user;
  


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Commandeproduits
     *
     * @param \OC\PlatformBundle\Entity\CommandeProduit $commandeproduits
     *
     * @return Commande
     */
    public function setCommandeproduits(\OC\PlatformBundle\Entity\CommandeProduit $commandeproduits = null)
    {
        $this->commandeproduits = $commandeproduits;

        return $this;
    }

    /**
     * Get commandeproduits
     *
     * @return \OC\PlatformBundle\Entity\CommandeProduit
     */
    public function getCommandeproduits()
    {
        return $this->commandeproduits;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commandeproduits = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etat = 0;
    }

    /**
     * Add commandeproduit
     *
     * @param \OC\PlatformBundle\Entity\CommandeProduit $commandeproduit
     *
     * @return Commande
     */
    public function addCommandeproduit(\OC\PlatformBundle\Entity\CommandeProduit $commandeproduit)
    {
        $this->commandeproduits[] = $commandeproduit;

        return $this;
    }

    /**
     * Remove commandeproduit
     *
     * @param \OC\PlatformBundle\Entity\CommandeProduit $commandeproduit
     */
    public function removeCommandeproduit(\OC\PlatformBundle\Entity\CommandeProduit $commandeproduit)
    {
        $this->commandeproduits->removeElement($commandeproduit);
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Commande
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat()
    {
        return $this->etat;
    }

  

    /**
     * Set user
     *
     * @param \OC\UserBundle\Entity\User $user
     *
     * @return Commande
     */
    public function setUser(\OC\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \OC\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}