<?php


namespace App\Tests\Controller;

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
            $testUser = $userRepository->findOneBy(['username' => 'User2']);
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
        yield ['accueil', '/','GET'];
        yield ['add_comment', '/trick/Sad/add_comment','GET'];
        yield ['add_comment', '/trick/Sad/add_comment','GET',302, false];
        yield ['create_group', '/group/create','GET'];
        yield ['create_group', '/group/create','GET',302, false];
        yield ['accueil_page', '/page=1','GET',200,false];
        yield ['login', '/login','GET',200,false];
        yield ['forgotpass', '/login/forgotPass','GET',200,false];
        yield ['creation_trick', '/trick/creation','GET'];
        yield ['creation_trick', '/trick/creation','GET',302,false];
        yield ['edit_trick', '/trick/grab/1-sad/edit','GET'];
        yield ['edit_trick', '/trick/grab/1-sad/edit','GET',302,false];
        yield ['show_trick', '/trick/grab/1-sadpage=1','GET',200,false];
        yield ['upload_image_user', '/upload/image_user/2','GET',302,false];
        yield ['upload_image_user', '/upload/image_user/2','GET'];
        yield ['registration', '/inscription','GET',200,false];
        yield ['show_user', '/user/2','GET',200,false];
        yield ['resetpass', '/login/resetPass/123456789','GET',200,false];
        yield ['validateUser', '/validateUser/123456789','GET',200,false];
    }
}
