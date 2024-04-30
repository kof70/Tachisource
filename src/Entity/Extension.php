<?php

namespace App\Entity;

use App\Repository\ExtensionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: ExtensionRepository::class)]
#[Vich\Uploadable]
class Extension
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    /**
     * @var Collection<int, TypeExtension>
     */
    #[ORM\ManyToMany(targetEntity: TypeExtension::class, inversedBy: 'extensions')]
    private Collection $type;

    #[ORM\ManyToOne(inversedBy: 'extensions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Langue $langue = null;

    #[Vich\UploadableField(mapping: 'apk', fileNameProperty: 'apkName')]
    private ?File $apkFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $apkName = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        //$this->updatedAt = new \DateTimeImmutable('now');
        $this->type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection<int, TypeExtension>
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(TypeExtension $type): static
    {
        if (!$this->type->contains($type)) {
            $this->type->add($type);
        }

        return $this;
    }

    public function removeType(TypeExtension $type): static
    {
        $this->type->removeElement($type);

        return $this;
    }

    public function getLangue(): ?Langue
    {
        return $this->langue;
    }

    public function setLangue(?Langue $langue): static
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $apkFile
     */
    public function setapkFile(?File $apkFile = null): void
    {
        $this->apkFile = $apkFile;

        if (null !== $apkFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable('now');
        }
    }

    public function getapkFile(): ?File
    {
        return $this->apkFile;
    }

    public function setapkName(?string $apkName): void
    {
        $this->apkName = $apkName;
    }

    public function getapkName(): ?string
    {
        return $this->apkName;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAd(?\DateTimeImmutable $immutable)
    {
        $this->updatedAt = $immutable;
    }


    public function __toString()
    {
        return $this->getNom();
    }
}