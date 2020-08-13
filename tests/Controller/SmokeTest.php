<?php


namespace App\Tests\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful($pageName, $url, $method = "GET", $expectedStatusCode = 200, $withLogin = true)
    {
        $client = self::createClient();

        if ($withLogin) {

            $userRepository = static::$container->get(UserRepository::class);
            $testUser = $userRepository->findOneBy(['username' => 'user2']);
            $client->catchExceptions(false);
            $client->loginUser($testUser);
        }

        $client->request($method, $url );
        $response = $client->getResponse();

        self::assertSame(
            $response->getStatusCode(),
            $expectedStatusCode,
            sprintf(
                'La page "%s" devrait être accessible, mais le code HTTP est "%s".',
                $pageName,
                $response->getStatusCode()
            )
        );
    }

    public function provideUrls()
    {
        yield ['accueil', '/','GET', 200];
        yield ['add_comment', '/trick/Sad/add_comment','GET',200];
        yield ['add_comment', '/trick/Sad/add_comment','GET',302, false];
        yield ['create_group', '/group/create','GET',200];
        yield ['create_group', '/group/create','GET',302, false];
        yield ['accueil_page', '/page=1','GET',200,false];
        yield ['validateUser', '/validateUser/f7a83f203e120eea','GET',200,false];
        yield ['login', '/login','GET',200,false];
        yield ['forgotpass', '/login/forgotPass','GET',200,false];
        yield ['resetpass', '/login/resetPass/f7a83f203e120eea','GET',200,false];
        yield ['creation_trick', '/trick/creation','GET',200];
        yield ['creation_trick', '/trick/creation','GET',302,false];
        yield ['edit_trick', '/trick/grab/31-sad/edit','GET',200];
        yield ['edit_trick', '/trick/grab/31-sad/edit','GET',302,false];
        yield ['show_trick', '/trick/grab/31-sadpage=1','GET',200,false];
        yield ['upload_image_user', '/upload/image_user/70','GET',302,false];
        yield ['upload_image_user', '/upload/image_user/70','GET',200];
        yield ['registration', '/inscription','GET',200,false];
        yield ['show_user', '/user/70','GET',200,false];
    }
}
