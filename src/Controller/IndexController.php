<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use App\Entity\Question;
use App\Entity\Reponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;


class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
    
        $repository = $this->getDoctrine()->getRepository(Categorie::class);

        // $repository2 = $this->getDoctrine()->getRepository(Question::class);

        // $categoryName = $repository->find()->getCategorie();
        // dd($categoryName[0]->getQuestion());

        $res = $repository->findAll();
        return $this->render('index/index.html.twig',['res'=>$res]);
    }
    

    /**
     * @Route("/categorie/{id}/{quest}", name="categorie" , methods={"GET","HEAD","POST"})
     */
    public function show(int $id,int $quest, Request $request)
    {
        $session = new Session();
        if($quest == 0){
            $session->set($id, 0);
        } else {
            $score = $session->get($id);
        }
        

        $repository = $this->getDoctrine()->getRepository(Categorie::class);
        $res = $repository->findAll();
        $questions = $repository->find($id)->getCategorie();
        // dd(gettype($questions));
        if($quest >= 9){
            $quest = 'submit';
        } else {
            $quest++;
        }
        if(null != $request->request->get('reponse')){
            $resultat = $request->request->get('reponse');
            $reponse = $this->getDoctrine()->getRepository(Reponse::class);
            $expected = $reponse->findOneById($resultat)->getReponseExpected();
            if($expected == 1){
                $score++;
                $lastrep = true;
            } else {
                $lastrep = false;
            }
            $session->set($id, $score);
        } else {
            $resultat = 0;
            $lastrep = null;
        }
        $score = $session->get($id);
        return $this->render('question/question.html.twig',['res'=>$res,'question'=>$questions[$quest],'next'=>$quest, 'resultat' => $resultat,'lastrep'=>$lastrep,'score'=>$score]);
    }

    // /**
    //  * @Route("/login", name="login")
    //  */
    // public function login()
    // {
    //     return $this->render('index/index.html.twig', [
    //         'controller_name' => 'IndexController',
    //     ]);
    // }
}
