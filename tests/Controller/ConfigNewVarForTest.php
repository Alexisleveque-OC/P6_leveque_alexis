<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConfigNewVarForTest extends WebTestCase
{
    protected $userName = 'Usertest';
    protected $email = 'UserTest@test.com';
    protected $password = 'passTest';

    protected $groupName = 'GroupTest';
    protected $groupDescription = 'GroupDescription';

}