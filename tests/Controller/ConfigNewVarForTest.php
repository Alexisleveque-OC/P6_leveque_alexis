<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConfigNewVarForTest extends WebTestCase
{
    protected $userName = 'Usertest11';
    protected $email = 'UserTest11@test.com';
    protected $password = 'passTest';

    protected $groupName = 'GroupTest';
    protected $groupDescription = 'GroupDescription';

    protected $trickName = 'TrickTest';
    protected $trickDescription = 'TrickDescriptionTest';

    protected $videoIFrame0 = '<iframe width="560" height="315" src="https://www.youtube.com/embed/FMHiSF0rHF8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    protected $videoIFrame1 = '<iframe width="560" height="315" src="https://www.youtube.com/embed/FMHiSF0rHF8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    protected $videoIFrame2 = '<iframe width="560" height="315" src="https://www.youtube.com/embed/FMHiSF0rHF8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

}