<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Validator\Constraints as CustomAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

//     * @Assert\Regex("/^<iframe\s(.)*iframe>$/",message="Vous devez inclure la totalité du champ 'Intégrer la vidéo'.")
//     * @CustomAssert\LinkIsValid()
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iFrame;

    /**
     * @ORM\ManyToOne(targetEntity=Trick::class, inversedBy="videos")
     *
     */
    private $trick;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIFrame(): ?string
    {
        return $this->iFrame;
    }

    public function setIFrame(string $iFrame): self
    {
        $this->iFrame = $iFrame;

        return $this;
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
}
