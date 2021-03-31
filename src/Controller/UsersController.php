<?php

namespace App\Controller;

use App\Form\EditprofileType;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/users" , name="users_")
 */
class UsersController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('users/index.html.twig'
        );
    }
    /**
     * @Route("/profile/modifier", name="profile_modifier")
     */
    public function editProfile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditprofileType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('users_profile');
        }
        return $this->render('users/editprofile.html.twig', [
            'profileform' => $form->createView(),
        ]);
    }
    /**
     * @param UsersRepository $repository
     * @return Response
     * @Route("/list" , name="list")
     */
    public function Affiche (UsersRepository  $repository)
    {
        #$repository->$this->getDoctrine()->getRepository(Users::class);
        $users = $repository->findall();
        return $this->render('users/userslist.html.twig',
            ['users' => $users]);
    }

    /**
     * @Route("/resume", name="resume")
     */
    public function Resume(): Response
    {
        $user = $this->getUser();
        return $this->render('users/resume.html.twig'
        );
    }





    /**
     * @Route("/recherche", name="recherche_users")
     */
    public function searchAction(Request $request)
    {

        $data = $request->request->get('search');


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT u FROM App\Entity\Users u WHERE u.nom    LIKE :data')
            ->setParameter('data', '%'.$data.'%');


        $users = $query->getResult();

        return $this->render('users/userslist.html.twig', [
            'users' => $users,
        ]);

    }
    /**
     * @Route("consultercv/{id}",name="consultercv")
     */
    function ConsultCV($id, UsersRepository  $repository ) {
        $user=$repository->find($id);
        $em=$this->getDoctrine()->getManager();

        return $this->render('users/consultercv.html.twig',[
                'user' => $user,

        ]);
    }

}
