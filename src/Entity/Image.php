<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    const DIR_PATH = '/image';
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Trick::class, inversedBy="images", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $trick;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="image")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fileName;

    /**
     * @var ?File
     */
    private $file;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    public function getUrl()
    {
        return self::DIR_PATH . '/' . $this->fileName;
    }

//    public function addTricks(Trick $trick)
//    {
//        if (!$this->trick->contains($trick)) {
//            $this->trick->add($trick);
//        }
//    }

    /**
     * @return File|null ?File
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File|null $file
     * @return Image
     */
    public function setFile(?File $file): Image
    {
        $this->file = $file;

        return $this;
    }
}
