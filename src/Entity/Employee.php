<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Employee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fio;
    /**
     * @ORM\Column(type="date")
     */
    private $bdate;
     /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;
    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Subdivision", mappedBy="fk_dir")
     */
    private $subdivisions;

    public function __construct()
    {
        $this->subdivisions = new ArrayCollection();
    }
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getFio(): ?string
    {
        return $this->fio;
    }
    public function setFio(string $fio): self
    {
        $this->fio = $fio;
        return $this;
    }
    public function getBdate(): ?\DateTimeInterface
    {
        return $this->bdate;
    }
    public function setBdate(\DateTimeInterface $bdate): self
    {
        $this->bdate = $bdate;
        return $this;
    }
      public function getImageFile()
    {
        return $this->imageFile;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return Collection|Subdivision[]
     */
    public function getSubdivisions(): Collection
    {
        return $this->subdivisions;
    }

    public function addSubdivision(Subdivision $subdivision): self
    {
        if (!$this->subdivisions->contains($subdivision)) {
            $this->subdivisions[] = $subdivision;
            $subdivision->setFkDir($this);
        }

        return $this;
    }

    public function removeSubdivision(Subdivision $subdivision): self
    {
        if ($this->subdivisions->contains($subdivision)) {
            $this->subdivisions->removeElement($subdivision);
            // set the owning side to null (unless already changed)
            if ($subdivision->getFkDir() === $this) {
                $subdivision->setFkDir(null);
            }
        }

        return $this;
    }
    
}