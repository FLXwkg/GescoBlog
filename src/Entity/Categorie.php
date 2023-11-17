<?php
namespace App\Entity;

class Categorie
{
    /**
     * @var int
     */
    protected int $id_categorie;

    /**
     * @var string
     */
    protected string $nom_categorie;

    /**
     * @var string
     */
    protected string $slug;

    /**
     * @param int $id
     * @return Categorie 
     */
    public function setId(int $id): Categorie
    {
        $this->id_categorie = $id;
        return $this;
    }

    /**
     * @return int 
     */
    public function getId(): int
    {
        return $this->id_categorie;
    }

    /**
     * @param string $nom
     * @return Categorie 
     */
    public function setNom(string $nom): Categorie
    {
        $this->nom_categorie = $nom;
        return $this;
    }

    /**
     * @return string 
     */
    public function getNom(): string
    {
        return $this->nom_categorie;
    }

    /**
     * @param string $slug
     * @return Categorie 
     */
    public function setSlug(int $slug): Categorie
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string 
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}