<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
    
        $repository = $this->getDoctrine()->getRepository(Categorie::class);
        $res = $repository->findAll();
        return $this->render('index/index.html.twig',['res'=>$res]);
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
