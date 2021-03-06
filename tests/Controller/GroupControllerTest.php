<?php


namespace App\Tests\Controller;


use App\Entity\Group;
use App\Repository\GroupRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GroupControllerTest extends WebTestCase
{
    public function testCreateGroup()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $groupRepository = static::$container->get(GroupRepository::class);

        $testUser = $userRepository->findOneBy(['username' => 'UserTest']);
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/trick/creation');

        static::assertSame(1, $crawler->filter('div#createGroupModal.modal')->count());

        $form = $crawler->selectButton('Enregistrer')->form();
        $form['group[title]'] = 'GroupTest';
        $form['group[description]'] = 'GroupDescription';
        $client->submit($form);

        $testGroup = $groupRepository->findOneBy(['title' => 'GroupTest']);

        static::assertInstanceOf(Group::class, $testGroup);
        static::assertSame('GroupTest', $testGroup->getTitle());
        static::assertSame('GroupDescription', $testGroup->getDescription());

        //redirect to trick/creation
        static::assertSame(1, $crawler->filter('div.create_trick')->count());

    }

}