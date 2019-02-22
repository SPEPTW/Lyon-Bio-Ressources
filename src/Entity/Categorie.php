<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $type_categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeCategorie(): ?int
    {
        return $this->type_categorie;
    }

    public function setTypeCategorie(int $type_categorie): self
    {
        $this->type_categorie = $type_categorie;

        return $this;
    }
}
