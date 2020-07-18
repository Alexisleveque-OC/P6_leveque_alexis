<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/", name="home")
     * @param TrickRepository $trickRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home(TrickRepository $trickRepository)
    {
        $tricks = $trickRepository->findBy([],['id'=>'DESC']);

        foreach ($tricks as $trick){
            $trick->setDescription(substr($trick->getDescription(),0,30) .' ...');
        }
        return $this->render('main/home.html.twig',[
            'tricks' => $tricks
        ]);
    }

}
