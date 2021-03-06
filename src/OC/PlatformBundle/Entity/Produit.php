<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="decimal", scale = 2)
     */
    private $prix;

    /**
    * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Gamme")
    * @ORM\JoinColumn(nullable=false)
    */
    private $gamme;

    /**
    * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\Ingredient", cascade={"persist"})
     */
    private $ingredients;
  
  
  
  
  
  
   
  
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
     * Set name
     *
     * @param string $name
     *
     * @return Produit
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }
  
    /**
     * Get gamme
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGamme()
    {
        return $this->gamme;
    }
  
  
  
  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ingredient
     *
     * @param \OC\PlatformBundle\Entity\Ingredient $ingredient
     *
     * @return Produit
     */
    public function addIngredient(\OC\PlatformBundle\Entity\Ingredient $ingredient)
    {
        $this->ingredients[] = $ingredient;

        return $this;
    }

    /**
     * Remove ingredient
     *
     * @param \OC\PlatformBundle\Entity\Ingredient $ingredient
     */
    public function removeIngredient(\OC\PlatformBundle\Entity\Ingredient $ingredient)
    {
        $this->ingredients->removeElement($ingredient);
    }

    /**
     * Get ingredients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }
}
