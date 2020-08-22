<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Group;
use App\Entity\Image;
use App\Entity\Token;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Video;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var SluggerInterface
     */
    private $slugger;

    public function __construct(UserPasswordEncoderInterface $encoder, SluggerInterface $slugger)
    {
        $this->encoder = $encoder;
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager)
    {
        $groups = [];
        $users = [];
        $tricks = [];

        //group creation
        $group1 = new Group();
        $group1->setTitle('Grab')
            ->setDescription('Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. »
Il existe plusieurs types de grabs selon la position de la saisie et la main choisie pour l\'effectuer, avec des difficultés variables');
        $slug = $this->slugger->slug($group1->getTitle());
        $group1->setSlug($slug);
        $manager->persist($group1);
        $groups [] = $group1;

        $group2 = new Group();
        $group2->setTitle('Rotation')
            ->setDescription('On désigne par le mot « rotation » uniquement des rotations horizontales ; les rotations verticales sont des flips. Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal. La nomenclature se base sur le nombre de degrés de rotation effectués.');
        $slug = $this->slugger->slug($group2->getTitle());
        $group2->setSlug($slug);
        $manager->persist($group2);
        $groups [] = $group2;

        $group3 = new Group();
        $group3->setTitle('Flip')
            ->setDescription('On désigne par le mot « rotation » uniquement des rotations horizontales ; les rotations verticales sont des flips. Le principe est d\'effectuer une rotation horizontale pendant le saut, puis d\'attérir en position switch ou normal. La nomenclature se base sur le nombre de degrés de rotation effectués.');
        $slug = $this->slugger->slug($group3->getTitle());
        $group3->setSlug($slug);
        $manager->persist($group3);
        $groups [] = $group3;

        $group4 = new Group();
        $group4->setTitle('Désaxés')
            ->setDescription('Mix entre flips et rotations');
        $slug = $this->slugger->slug($group4->getTitle());
        $group4->setSlug($slug);
        $manager->persist($group4);
        $groups [] = $group4;

        // user creation
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setUsername(sprintf('User%d', $i))
                ->setEmail(sprintf('user%d@snowtricks.com', $i))
                ->setPassword('coucou')
                ->setValidation(true);
            $hash = $this->encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);

            if ($i === 1 || $i === 2) {
                $imageUser1 = new Image();
                $imageUser1->setFileName('thumb-129186-5f1ace74e88f3.jpeg')
                    ->setUser($user);
                $manager->persist($imageUser1);
            }
            if ($i === 3 || $i === 4) {
                $imageUser2 = new Image();
                $imageUser2->setFileName('unknown-person-silhouette-whith-blue-tie-vector-3212981-5f23b56131c64.jpeg')
                    ->setUser($user);
                $manager->persist($imageUser2);
            }
            $token = new Token();
            if ($i === 1) {
                $token->setToken('123456789');
            }
            $token->setUser($user);
            $manager->persist($token);

            $users[] = $user;
        }

        // trick creation and associated image
        $loremDescription = '<h3>Super figure</h3><p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipisicing elit. Consequuntur deleniti ea eius enim
    harum ipsum quia veritatis? Inventore, quae, quibusdam.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur deleniti ea eius enim
    harum ipsum quia veritatis? Inventore, quae, quibusdam.</p>';

        $trick1 = new Trick();
        $trick1->setName('Sad')
            ->setDescription($loremDescription)
            ->setCreatedAt(new DateTime())
            ->setGroupName($groups[0]);
        $slug = $this->slugger->slug($trick1->getName());
        $trick1->setSlug($slug);
        $trick1->setUser($users[mt_rand(0, 9)]);
        $manager->persist($trick1);
        $tricks[] = $trick1;

        $image1 = new Image();
        $image1->setFileName('bawbaw-snow-5f1e5e2aedbd3.jpeg')
            ->setTrick($trick1);
        $manager->persist($image1);
        $image2 = new Image();
        $image2->setFileName('telechargement-5f1e5e3731af6.jpeg')
            ->setTrick($trick1);
        $manager->persist($image2);


        $trick2 = new Trick();
        $trick2->setName('Indy')
            ->setDescription($loremDescription)
            ->setCreatedAt(new DateTime())
            ->setGroupName($groups[0]);
        $slug = $this->slugger->slug($trick2->getName());
        $trick2->setSlug($slug);
        $trick2->setUser($users[mt_rand(0, 9)]);
        $manager->persist($trick2);
        $tricks[] = $trick2;

        $image3 = new Image();
        $image3->setFileName('indy-5f1e6a77eb3cb.jpeg')
            ->setTrick($trick2);
        $manager->persist($image3);
        $image4 = new Image();
        $image4->setFileName('indy2-5f1e6a81b8202.jpeg')
            ->setTrick($trick2);
        $manager->persist($image4);

        $trick3 = new Trick();
        $trick3->setName('180')
            ->setDescription($loremDescription)
            ->setCreatedAt(new DateTime())
            ->setGroupName($groups[1]);
        $slug = $this->slugger->slug($trick3->getName());
        $trick3->setSlug($slug);
        $trick3->setUser($users[mt_rand(0, 9)]);
        $manager->persist($trick3);
        $tricks[] = $trick3;

        $image5 = new Image();
        $image5->setFileName('180-5f1e6dc549adc.jpeg')
            ->setTrick($trick3);
        $manager->persist($image5);

        $trick4 = new Trick();
        $trick4->setName('360')
            ->setDescription($loremDescription)
            ->setCreatedAt(new DateTime())
            ->setGroupName($groups[1]);
        $slug = $this->slugger->slug($trick4->getName());
        $trick4->setSlug($slug);
        $trick4->setUser($users[mt_rand(0, 9)]);
        $manager->persist($trick4);
        $tricks[] = $trick4;

        $image6 = new Image();
        $image6->setFileName('360-5f1e6e2b4d141.jpeg')
            ->setTrick($trick4);
        $manager->persist($image6);

        $trick5 = new Trick();
        $trick5->setName('Backflip')
            ->setDescription($loremDescription)
            ->setCreatedAt(new DateTime())
            ->setGroupName($groups[2]);
        $slug = $this->slugger->slug($trick5->getName());
        $trick5->setSlug($slug);
        $trick5->setUser($users[mt_rand(0, 9)]);
        $manager->persist($trick5);
        $tricks[] = $trick5;

        $image7 = new Image();
        $image7->setFileName('backflip2-5f1e716be9cf0.jpeg')
            ->setTrick($trick5);
        $manager->persist($image7);
        $image8 = new Image();
        $image8->setFileName('backflip-5f1e7174d1ae6.jpeg')
            ->setTrick($trick5);
        $manager->persist($image8);

        $trick6 = new Trick();
        $trick6->setName('Frontflip')
            ->setDescription($loremDescription)
            ->setCreatedAt(new DateTime())
            ->setGroupName($groups[2]);
        $slug = $this->slugger->slug($trick6->getName());
        $trick6->setSlug($slug);
        $trick6->setUser($users[mt_rand(0, 9)]);
        $manager->persist($trick6);
        $tricks[] = $trick6;

        $image9 = new Image();
        $image9->setFileName('6ea3b44dd4625f9ec0aa6909fc25b49f-5f1e726c70fc5.jpeg')
            ->setTrick($trick6);
        $manager->persist($image9);

        $trick7 = new Trick();
        $trick7->setName('Rodéo')
            ->setDescription($loremDescription)
            ->setCreatedAt(new DateTime())
            ->setGroupName($groups[3]);
        $slug = $this->slugger->slug($trick7->getName());
        $trick7->setSlug($slug);
        $trick7->setUser($users[mt_rand(0, 9)]);
        $manager->persist($trick7);
        $tricks[] = $trick7;

        $image10 = new Image();
        $image10->setFileName('rodeo-5f1e76eb9be4a.jpeg')
            ->setTrick($trick7);
        $manager->persist($image10);
        $image11 = new Image();
        $image11->setFileName('rodeo-2-5f1e76f3b5109.jpeg')
            ->setTrick($trick7);
        $manager->persist($image11);

        $trick8 = new Trick();
        $trick8->setName('Frontside Cork 540')
            ->setDescription($loremDescription)
            ->setCreatedAt(new DateTime())
            ->setGroupName($groups[3]);
        $slug = $this->slugger->slug($trick8->getName());
        $trick8->setSlug($slug);
        $trick8->setUser($users[mt_rand(0, 9)]);
        $manager->persist($trick8);
        $tricks[] = $trick8;

        $image12 = new Image();
        $image12->setFileName('fro-5f1e77cba481b.jpeg')
            ->setTrick($trick8);
        $manager->persist($image12);
        $image13 = new Image();
        $image13->setFileName('fr-5f1e77d3ab6ce.jpeg')
            ->setTrick($trick8);
        $manager->persist($image13);

        $video1 = new Video();
        $video1->setIFrame('https://youtube.com/embed/FMHiSF0rHF8')
            ->setTrick($trick8);
        $manager->persist($video1);
        $video2 = new Video();
        $video2->setIFrame('https://youtube.com/embed/jTEQUyruKfE')
            ->setTrick($trick8);
        $manager->persist($video2);

        //comment creation
        $loremCommentContent = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, unde! Aliquam
    debitis deserunt dolores dolorum iure! Commodi optio provident soluta?';

        foreach ($tricks as $trick) {
            for ($j = 1; $j <= mt_rand(8, 22); $j++) {
                $comment = new Comment();
                $comment->setUser($users[mt_rand(0, 9)])
                    ->setContent($loremCommentContent)
                    ->setCreatedAt(new DateTime())
                    ->setTrick($trick);
                $manager->persist($comment);
            }
        }


        $manager->flush();
    }
}
