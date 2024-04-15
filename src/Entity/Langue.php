<?php

namespace App\Entity;

use App\Repository\LangueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LangueRepository::class)]
class Langue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nomlangue = null;

    #[ORM\Column(length: 10)]
    private ?string $sigle = null;

    /**
     * @var Collection<int, Extension>
     */
    #[ORM\OneToMany(targetEntity: Extension::class, mappedBy: 'langue')]
    private Collection $extensions;


    public function __construct()
    {
        $this->extensions = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomlangue(): ?string
    {
        return $this->nomlangue;
    }

    public function setNomlangue(string $nomlangue): static
    {
        $this->nomlangue = $nomlangue;

        return $this;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(string $sigle): static
    {
        $this->sigle = $sigle;

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
            $extension->setLangue($this);
        }

        return $this;
    }

    public function removeExtension(Extension $extension): static
    {
        if ($this->extensions->removeElement($extension)) {
            // set the owning side to null (unless already changed)
            if ($extension->getLangue() === $this) {
                $extension->setLangue(null);
            }
        }

        return $this;
    }
}