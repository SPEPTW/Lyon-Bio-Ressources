<?php

namespace App\Entity\Lbr;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Lbr\ContactRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(min=2, max=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(max=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Assert\Email(
     * message = "L'Email'{{ value }}' n'ai pas une adresse mail valide.")
     * 
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     * 
     */
    private $rue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $ville;

    /**
     * @Assert\Regex("/^[0-9]{5}$/")
     * @ORM\Column(type="string", nullable=true)
     */
    private $code_postale;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lbr\Categorie", inversedBy="contacts")
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Lbr\Organisation", inversedBy="contacts")
     */
    private $organisation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lbr\Evenement", inversedBy="contacts")
     */
    private $evenement;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Regex("/^[0-9]{10}$/")
     */
    private $tel_1;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Regex("/^[0-9]{10}$/")
     */
    private $tel_2;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Regex("/^[0-9]{10}$/")
     */
    private $tel_3;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    public function __construct()
    {
        $this->organisation = new ArrayCollection();
        $this->setCreatedAt( new \DateTime('now') );
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function onUpdate()
    {
        $this->setUpdatedAt( new \DateTime('now') );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostale(): ?string
    {
        return $this->code_postale;
    }

    public function setCodePostale(?string $code_postale): self
    {
        $this->code_postale = $code_postale;

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(?bool $statut): self
    {
        $this->statut = $statut;

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
     * @return Collection|Organisation[]
     */
    public function getOrganisation(): Collection
    {
        return $this->organisation;
    }

    public function addOrganisation(Organisation $organisation): self
    {
        if (!$this->organisation->contains($organisation)) {
            $this->organisation[] = $organisation;
        }

        return $this;
    }

    public function removeOrganisation(Organisation $organisation): self
    {
        if ($this->organisation->contains($organisation)) {
            $this->organisation->removeElement($organisation);
        }

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }

    public function getTel1(): ?string
    {
        return $this->tel_1;
    }

    public function setTel1(?string $tel_1): self
    {
        $this->tel_1 = $tel_1;

        return $this;
    }

    public function getTel2(): ?string
    {
        return $this->tel_2;
    }

    public function setTel2(?string $tel_2): self
    {
        $this->tel_2 = $tel_2;

        return $this;
    }

    public function getTel3(): ?string
    {
        return $this->tel_3;
    }

    public function setTel3(?string $tel_3): self
    {
        $this->tel_3 = $tel_3;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }
}
