<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\EditUserType;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route ("/admin",name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    /**
     * @param UsersRepository $repository
     * @return Response
     * @Route("/utilisateurs" , name="utilisateurs")
     */
    public function Affiche (UsersRepository  $repository)
    {
        #$repository->$this->getDoctrine()->getRepository(Users::class);
        $users = $repository->findall();
        return $this->render('admin/users.html.twig',
            ['users' => $users]);
    }
    /**
     * @Route("/utilisateurs/modifier/{id}", name="modifier_utilisateur")
     */
    public function editUser( Users $user, \Symfony\Component\HttpFoundation\Request $request )
    {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Utilisateur modifié avec succès');
            return $this->redirectToRoute('admin_utilisateurs');
        }

        return $this->render('admin/edituser.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("utilisateurs/Supp/{id}",name="users_delete")
     */
    function Delete($id, UsersRepository  $repository ) {
        $user=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('admin_utilisateurs');
    }
    /**
     * @Route("utilisateurs/block",name="users_block")
     */
    public function block($id, UserInterface $user)
    {
        $user->setBlocked(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $this->redirectToRoute('admin_utilisateurs');
    }
    /**
     * @Route("utilisateurs/unblock",name="users_unblock")
     */
    public function unblock($id, UserInterface $user)
    {
        $user->setBlocked(false);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $this->redirectToRoute('admin_utilisateurs');
    }

    /**
     * @param UsersRepository $repository
     * @return Response
     * @Route("/statistique" , name="statistique")
     */

        public function stat (UsersRepository  $repository)
    {
        $users = $repository->findall();
        return $this->render('admin/statistique.html.twig' ,['users' => $users]);
    }


}
