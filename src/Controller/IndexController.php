<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use App\Entity\Question;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
    
        $repository = $this->getDoctrine()->getRepository(Categorie::class);

        $repository2 = $this->getDoctrine()->getRepository(Question::class);

        $categoryName = $repository2->getCategorie();
        $res = $repository->findAll();
        return $this->render('index/index.html.twig',['res'=>$res,'question'=>$categoryName]);
    }
    

    /**
     * @Route("/register", name="register")
     */
    public function register()
    {
        return $this->render('index/index.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
