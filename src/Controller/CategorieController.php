<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Categorie;

use App\Form\CategorieType;

use App\Repository\CategorieRepository;
use App\Entity\Article;

use App\Form\ArticleType;

use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;



use Symfony\Component\HttpFoundation\Request;



use Symfony\Contracts\Cache\ItemInterface;


class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="app_categorie")
     */
    
    public function index():Response
    { 
        $entityManager = $this->getDoctrine()->getManager();
        $categorie = new Categorie();
        $categorie->setNomCategorie('parfums');
    
        $entityManager->persist($categorie);
        $entityManager->flush();
        return $this->render('pages/categorie/new.html.twig');
    }
    
        
        /**
        * @Route("/ajoutCat" , name="liste")
        */
        public function ajout(Request $request)
        {
           
            $categorie = new Categorie();
            $form=$this->createForm("App\Form\CategorieType");
            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                
                $em=$this->getDoctrine()->getManager();
                $em->persist($categorie);
                $em->flush();
                $session = new session();
                $session->getFlashBag()->add('notice','categorie bien ajoutée');
                return $this->redirectToRoute('ajoutCat');

               
    
            }
               
            return $this->render('pages/categorie/new.html.twig', [
                'form' => $form->createView() ,'categorie' => $categorie
            ]);}
            /** 
            *@Route("/categories",name="cat")
            *@param categorie $Categorie
            *@param lesCategories $lesCategories
            */
           public function home(CategorieRepository $repository):Response
           {
            $categorie = new Categorie();
            $em=$this->getDoctrine()->getManager();
            $repository=$em->getRepository(Categorie::class); 
           $em =$this->getDoctrine()->getManager();
           $repository=$em->getRepository(Categorie::class);
           $lesCategories = $repository ->findAll();
           
           
        
           return $this->render('pages\categorie\index.html.twig',['lesCategories' => $lesCategories , 'categorie' => $categorie]);}

        /**
         * @Route("/showCategorie/{id}",name="showCategorie")
         */
        public function show($id) : Response
        { 
        $categorie = new Categorie();
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(Categorie::class);   
       
        $categorie=$repository->find($id);
         if (!$categorie)
         {
            throw $this->createNotFoundException( 'No categorie found for id '.$id );
        }
       
        return $this->render('pages/categorie/show.html.twig',['categorie'=>$categorie]);  }
  
    }
    

    

  


    /*
    *Route('/edition/{id}', name='edit')
     */
    
     /*public function edit(
        Categorie $categorie,
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();

            $manager->persist($categorie);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre ingrédient a été modifié avec succès !'
            );

            return $this->redirectToRoute('categorie.index');
        }

        return $this->render('pages/Categorie/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * This controller allow us to delete a categorie
     *  Route('/recette/suppression/{id}', name='categorie.delete')
   
     */

   
    /*public function delete(
        EntityManagerInterface $manager,
        Categorie $categorie
    ): Response {
        $manager->remove($categorie);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre recette a été supprimé avec succès !'
        );

        return $this->redirectToRoute('categorie.index');
    }


}*/

