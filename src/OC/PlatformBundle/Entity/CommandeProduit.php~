<?php

namespace OC\PlatformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;



/**
 * CommandeProduit
 *
 * @ORM\Table(name="CommandeProduit")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\CommandeProduitRepository")
 */
class CommandeProduit
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
    * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Commande", inversedBy="commandeproduits")
    * @ORM\JoinColumn(nullable=false)
    */
    private $commande;
  
  
   /**
    * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Produit")
    * @ORM\JoinColumn(nullable=false)
    */
    private $produit;
  
  
    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;
  
      
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
     * Set commande
     *
     * @param \OC\PlatformBundle\Entity\Commande $commande
     *
     * @return CommandeProduit
     */
    public function setCommande(\OC\PlatformBundle\Entity\Commande $commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \OC\PlatformBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

  
    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return CommandeProduit
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
     * Set produit
     *
     * @param \OC\PlatformBundle\Entity\Produit $produit
     *
     * @return  CommandeProduit
     */
    public function setProduit(\OC\PlatformBundle\Entity\Produit $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \OC\PlatformBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }
}
