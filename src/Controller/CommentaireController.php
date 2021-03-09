<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="commentaire",methods={"POST","GET"})
     */
    public function index(CommentaireRepository $repo, Request $request, EntityManagerInterface $manager): Response
    {
        $comm=new Commentaire();
        


        //Mapper le formulaire et l'objet $article
        $form = $this->createForm(CommentaireType::class, $comm);

        //Recuperation $_POST['name']
        //hydratation de $categorie à partir des Données du formulaire
        $form->handleRequest($request);

        // isset($_POST['name_btn'])
        if ($form->isSubmitted()) {
          
            //Ajout
            $manager->persist($comm);
            $manager->flush();
           
            $this->addFlash('success', 'Votre commentaire a été envoyé');

            return $this->redirectToRoute('commentaire');
        }



        return $this->render('commentaire/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/commentaire/all", name="commentaire_all",methods={"POST","GET"})
     */
    public function listComm(CommentaireRepository $repo, Request $request, EntityManagerInterface $manager): Response
    {
        $comms =$repo->findAll();


        return $this->render('commentaire/listComm.html.twig', [
            'comms'=>$comms,
            
        ]);
    }
}
