<?php


namespace App\Tests\Controller;


use App\Entity\Image;
use App\Entity\Video;
use App\Repository\GroupRepository;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use App\Repository\VideoRepository;

class TrickControllerTest extends ConfigNewVarForTest
{
    public function testTrickCreation()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $groupRepository = static::$container->get(GroupRepository::class);
        $imageRepository = static::$container->get(ImageRepository::class);
        $videoRepository = static::$container->get(VideoRepository::class);

        $imageTest0 = $this->createMock(Image::class);
        $imageTest1 = $this->createMock(Image::class);
        $imageTest2 = $this->createMock(Image::class);

        $videoTest0 = $this->createMock(Video::class);
        $videoTest1 = $this->createMock(Video::class);
        $videoTest2 = $this->createMock(Video::class);

        $testUser = $userRepository->findOneBy(['username'=>$this->userName]);
        $client->loginUser($testUser);

        $groupTest = $groupRepository->findOneBy(['title'=>$this->groupName]);

        $crawler = $client->request('GET', '/trick/creation');

        static::assertSame(1, $crawler->filter('div.create_trick')->count());

        $form = $crawler->selectButton('Créer le trick');
        $form['trick_create[groupName]'] = $groupTest;
        $form['trick_create[name]'] = $this->trickName;
        $form['trick_create[groupName]'] = $this->trickDescription;
        $form['trick_create_images_0'] = $imageTest0;
        $form['trick_create_images_1'] = $imageTest1;
        $form['trick_create_images_2'] = $imageTest2;
        $form['trick_create[videos][0][iFrame]'] = $this->videoIFrame0;
        $form['trick_create[videos][1][iFrame]'] = $this->videoIFrame1;
        $form['trick_create[videos][2][iFrame]'] = $this->videoIFrame2;

    }

}