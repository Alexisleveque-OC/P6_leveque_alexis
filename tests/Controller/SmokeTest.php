<?php
//
//
//namespace App\Tests\Controller;
//
//use App\Entity\User;
//use App\Repository\UserRepository;
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//
//class SmokeTest extends WebTestCase
//{
//    /**
//     * @dataProvider provideUrls
//     */
//    public function testPageIsSuccessful($pageName, $url)
//    {
//        $client = self::createClient();
//        $userRepository = static::$container->get(UserRepository::class);
//
//        $testUser = $userRepository->findOneBy(['username'=>'user2']);
//
//        $client->catchExceptions(false);
//        $client->loginUser($testUser);
//        $client->request('GET', $url);
//        $response = $client->getResponse();
//
//        self::assertTrue(
//            $response->isSuccessful(),
//            sprintf(
//                'La page "%s" devrait être accessible, mais le code HTTP est "%s".',
//                $pageName,
//                $response->getStatusCode()
//            )
//        );
//    }
//
//    public function provideUrls()
//    {
//        yield ['accueil','/'];
//        yield ['add_comment','/trick/Sad/add_comment'];
////        yield ['delete_comment','/comment/delete/68'];
//        yield ['create_group','/group/create'];
//        yield ['accueil_page','/page=1'];
//        yield ['validateUser','/validateUser/f7a83f203e120eea'];
//        yield ['login','/login'];
//        yield ['forgotpass','/login/forgotPass'];
//        yield ['resetpass','/login/resetPass/f7a83f203e120eea'];
//        yield ['creation_trick','/trick/creation'];
//        yield ['edit_trick','/trick/grab/31-sad/edit'];
//        yield ['show_trick','/trick/grab/31-sadpage=1'];
////        yield ['delete_trick','/trick/delete/31'];
//        yield ['upload_image_user','/upload/image_user/70'];
//        yield ['registration','/inscription'];
//        yield ['show_user','/user/70'];
//    }
//}
