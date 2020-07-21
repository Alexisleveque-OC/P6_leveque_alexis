<?php


namespace App\Service\Trick;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;

class CreateGroup
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var AsciiSlugger
     */
    private $slugger;

    public function __construct(EntityManagerInterface $manager,SluggerInterface $slugger)
    {
        $this->manager = $manager;
        $this->slugger = $slugger;
    }

    public function saveGroup($formGroup)
    {
        $group = $formGroup->getData();
        $slug = $this->slugger->slug($group->getTitle());
        $group->setSlug($slug);
        $this->manager->persist($group);
        $this->manager->flush();

    }
}