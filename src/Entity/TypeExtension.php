<?php

namespace App\Entity;

use App\Repository\TypeExtensionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeExtensionRepository::class)]
class TypeExtension
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    /**
     * @var Collection<int, Extension>
     */
    #[ORM\ManyToMany(targetEntity: Extension::class, mappedBy: 'type')]
    private Collection $extensions;

    public function __construct()
    {
        $this->extensions = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection<int, Extension>
     */
    public function getExtensions(): Collection
    {
        return $this->extensions;
    }

    public function addExtension(Extension $extension): static
    {
        if (!$this->extensions->contains($extension)) {
            $this->extensions->add($extension);
            $extension->addType($this);
        }

        return $this;
    }

    public function removeExtension(Extension $extension): static
    {
        if ($this->extensions->removeElement($extension)) {
            $extension->removeType($this);
        }

        return $this;
    }

}
