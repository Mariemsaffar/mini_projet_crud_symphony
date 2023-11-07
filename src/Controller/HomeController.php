<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleRepository;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Entity\Categorie;

use App\Form\CategorieType;

use App\Repository\CategorieRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param article $Article
    *@param lesArticles $lesArticles
     */
 
           
            public function index(ArticleRepository $repository, Request $request):Response
            {
            $em =$this->getDoctrine()->getManager();
            $repository=$em->getRepository(Article::class);
            $lesArticles = $repository ->findAll();
            $publicPath = $request->getScheme().
            '://'.$request->getHttpHost().$request->getBasePath().'public/img';
           
            
         
            return $this->render('pages\article\index.html.twig',['lesArticles' => $lesArticles ,'publicPath' =>$publicPath]);}
        
    
}
