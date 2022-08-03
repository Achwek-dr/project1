<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
class AdminController extends AbstractController
{
    #[Route('/admin', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/admin/user', name: 'app_utilisateurs')]
    public function userist(UserRepository $user){
        return $this->render("admin/user.html.twig",['user'=>$user ->findAll()]);

    }
    #[Route('/admin/user/modifier/{id}', name: 'modifier_user')]
    public function edituser (User $user, Request $request  ,ManagerRegistry $doctrine){

        $form=$this->createForm(EditUserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $entityManager=$doctrine-> getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('message','utilisateur modifié avec succés');
            return $this->redirectToRoute('utilisateurs');
        }
        return $this->render("admin/EditUser.html.twig",[
            'userForm'=>$form->createView()
        ]);

    }
}
