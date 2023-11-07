<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormView;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Form\CategorieType;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;


class ArticleController extends AbstractController

{
    /**
    * @Route("/article", name="app_article")
    */
    public function index(ArticleRepository $repository):Response{
    

        $entityManager = $this->getDoctrine()->getManager();
        $article = new Article();
        $article->setLibelle('narcisso');
        $article->setIsDisponible('narcisso');
        $article->setPrice('narcisso');
        $article->setMarque('narcisso');
        $article->setImage('narcisso');
        

    
        $entityManager->persist($article);
        $entityManager->flush();
        return $this->render('pages/article/index.html.twig');
    }
    public function show($id)
    { 
        $article = $this->getDoctrine()
       ->getRepository(Article::class);
        $em =$this->getDoctrine()->getManager();
        $repository=$em->getRepository(Article::class);
        $lesArticles = $repository ->findAll();
        $article=$repository->find($id);
         if (!$article)
         {
            throw $this->createNotFoundException( 'No article found for id '.$id );
        }
       
        return $this->render('pages/article/index.html.twig',['lesArticles' => $lesArticles]); 
    } 
 

    /**
     * @Route("/Add", name="ajout")
     */
    public function ajout(Request $request): Response
    {
        $publicPath ="public/img/";
        $article = new Article();
        $form=$this->createForm("App\Form\ArticleType",$article);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $image = $form ->get('image') ->getData();
            $em=$this->getDoctrine()->getManager();
            if($image){
                $imageName = $article->getMarque().'.'.$image->guessExtension();
                $image->move($publicPath,$imageName);
                $article->setImage($imageName);
            }
            $em=$this->getDoctrine()->getManager();
           $em->persist($article);
           $em->flush();
           $session = new session();
           $session->getFlashBag()->add('notice','article bien ajoutée');
           return $this->render('pages/article/index.html.twig');
           

        }

        
        return $this->render('pages/article/new.html.twig', [
            'form' => $form->createView()
        ]);}
        /*
        public function new(
            Request $request,
            EntityManagerInterface $manager
        ): Response {
            $article = new Article();
            $form = $this->createForm(ArticleType::class, $article);
    
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $article = $form->getData();
               
    
                $manager->persist($article);
                $manager->flush();
    
                $this->addFlash(
                    'success',
                    'Votre article a été créé avec succès !'
                );
    
                return $this->render('pages/article/index.html.twig');
            }
    
            return $this->render('pages/article/new.html.twig', [
                'form' => $form->createView()
            ]);
           */

               
            
            /** 
            *@Route("/",name="index")
            *@param article $Article
            *@param lesArticles $lesArticles
            */
           public function home(ArticleRepository $repository):Response
           {
           $em =$this->getDoctrine()->getManager();
           $repository=$em->getRepository(Article::class);
           $lesArticles = $repository ->findAll();
           
           
        
           return $this->render('pages\article\index.html.twig',['lesArticles' => $lesArticles]);}

          
            
   
      

          
     
        /**
        * @Route("/edition/article/{id}", name="edit")
        */
    
        public function edit(Request $request ): Response {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $manager->persist($article);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre article a été modifié avec succès !'
            );

            
        }

        return $this->render('pages/article/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/suppression/{id}", name="delete")
     * @param EntityManagerInterface $manager
     * @param Article $article
    */
    
    public function delete(EntityManagerInterface $manager): Response {
        $article = new Article();
        

        $manager->remove($article);
        $manager->flush();
        $em =$this->getDoctrine()->getManager();
        $repository=$em->getRepository(Article::class);
        $lesArticles = $repository ->findAll();

        $this->addFlash(
            'success',
            'Votre article a été supprimé avec succès !'
        );

        return $this->render('pages/article/index.html.twig' , ['lesArticles' => $lesArticles]);
    }
       

    

} 






      
    
    

   

    

