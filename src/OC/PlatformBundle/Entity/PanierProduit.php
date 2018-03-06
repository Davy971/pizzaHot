<?php

namespace OC\PlatformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;



/**
 * PanierProduit
 *
 * @ORM\Table(name="panierproduit")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\PanierProduitRepository")
 */
class PanierProduit
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
    * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Panier", inversedBy="panierproduits")
    * @ORM\JoinColumn(nullable=false)
    */
    private $panier;
  
  
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
     * Set panier
     *
     * @param \OC\PlatformBundle\Entity\Panier $panier
     *
     * @return PanierProduit
     */
    public function setPanier(\OC\PlatformBundle\Entity\Panier $panier)
    {
        $this->panier = $panier;

        return $this;
    }

    /**
     * Get panier
     *
     * @return \OC\PlatformBundle\Entity\Panier
     */
    public function getPanier()
    {
        return $this->panier;
    }

  
    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return PanierProduit
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
     * @return PanierProduit
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
