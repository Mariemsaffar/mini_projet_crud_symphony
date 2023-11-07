<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\JoinColumn(nullable=true)
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $is_disponible;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    public $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $marque;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class)
     * @ORM\JoinColumn(nullable=true)
     */
    public $Categorie;

    /**
     * @ORM\Column(type="string", length=255)
     * * @ORM\JoinColumn(nullable=true)
     */
    public $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getIsDisponible(): ?string
    {
        return $this->is_disponible;
    }

    public function setIsDisponible(string $is_disponible): self
    {
        $this->is_disponible = $is_disponible;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getCategorie(): ?categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
    * @return mixed
    */
    public function getImage()
    { 
        return $this->image; 
    } 
    /**
      * @param mixed $image 
      */
    public function setImage($image): void 
    {
         $this->image = $image;
    }
    
}
