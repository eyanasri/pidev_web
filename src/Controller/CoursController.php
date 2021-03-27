<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cours")
 */
class CoursController extends Controller
{


    /**
     * @Route("/formateur", name="cours_index", methods={"GET"})
     */
    public function index(CoursRepository $coursRepository, Request $request): Response
    {
        $allcours = $coursRepository->findAll();
        $cours = $this->get('knp_paginator')->paginate(
        // Doctrine Query, not results
            $allcours,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );
        return $this->render('cours/index.html.twig', [
            'cours' => $cours,
        ]);
    }

    /**
     * @Route("/admin", name="cours_admin", methods={"GET"})
     */
    public function indexx(CoursRepository $coursRepository, Request $request): Response
    {
        $allcours = $coursRepository->findAll();
        $cours = $this->get('knp_paginator')->paginate(
        // Doctrine Query, not results
            $allcours,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );
        return $this->render('cours/afficheadmin.html.twig', [
            'cours' => $cours,
        ]);
    }

    /**
     * @Route("/user", name="cours_user", methods={"GET"})
     */
    public function indexxx(CoursRepository $coursRepository, Request $request): Response
    {
        $allcours = $coursRepository->findAll();
        $cours = $this->get('knp_paginator')->paginate(
        // Doctrine Query, not results
            $allcours,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );
        return $this->render('cours/useraffiche.html.twig', [
            'cours' => $cours,
        ]);
    }


    /**
     * @Route("/new", name="cours_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $cour->getCategorie();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('upload_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $cour->setCategorie($fileName);


            $entityManager = $this->getDoctrine()->getManager();
            $cour->setCategorie($fileName);
            $entityManager->persist($cour);
            $entityManager->flush();
            return $this->redirectToRoute('cours_index');

        }

        return $this->render('cours/new.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/admin/ajouter", name="admin_new", methods={"GET","POST"})
     */
    public function neww(Request $request): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $cour->getCategorie();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('upload_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $cour->setCategorie($fileName);


            $entityManager = $this->getDoctrine()->getManager();
            $cour->setCategorie($fileName);
            $entityManager->persist($cour);
            $entityManager->flush();
            return $this->redirectToRoute('cours_admin');

        }

        return $this->render('cours/adminajout.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cours_show", methods={"GET"})
     */
    public function show(Cours $cour): Response
    {
        return $this->render('cours/show.html.twig', [
            'cour' => $cour,
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin_show", methods={"GET"})
     */
    public function showw(Cours $cour): Response
    {
        return $this->render('cours/showadmin.html.twig', [
            'cour' => $cour,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cours_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cours $cour): Response
    {
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cours_index');
        }

        return $this->render('cours/edit.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}/edit", name="admin_edit", methods={"GET","POST"})
     */
    public function edia(Request $request, Cours $cour): Response
    {
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cours_admin');
        }

        return $this->render('cours/adminedit.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cours_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cours $cour): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cours_index');
    }

    /**
     * @Route("/admin/{id}", name="admin_delete", methods={"DELETE"})
     */
    public function deletee(Request $request, Cours $cour): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cours_admin');
    }

    /**
     * @Route("triasc",name="triasc")
     */
    public function triasc(CoursRepository $repo, Request $request)
    {

        $paginator = $this->get('knp_paginator');
        $cour = $paginator->paginate(
            $repo->triasc(),
            $request->query->getInt('page', 1),
            8
        );
        return $this->render('cours/index.html.twig', [
            'cours' => $cour,
        ]);
    }

    /**
     * @Route("tria",name="tria")
     */
    public function tria(CoursRepository $repo, Request $request)
    {

        $paginator = $this->get('knp_paginator');
        $cour = $paginator->paginate(
            $repo->triasc(),
            $request->query->getInt('page', 1),
            8
        );
        return $this->render('cours/afficheadmin.html.twig', [
            'cours' => $cour,
        ]);
    }

    /**
     * @Route("tridesc",name="tridesc")
     */
    public function tridesc(CoursRepository $repo, Request $request)
    {

        $paginator = $this->get('knp_paginator');
        $cour = $paginator->paginate(
            $repo->tridesc(),
            $request->query->getInt('page', 1),
            8
        );
        return $this->render('cours/index.html.twig', [
            'cours' => $cour,
        ]);
    }

    /**
     * @Route("tride",name="tride")
     */
    public function tride(CoursRepository $repo, Request $request)
    {

        $paginator = $this->get('knp_paginator');
        $cour = $paginator->paginate(
            $repo->tridesc(),
            $request->query->getInt('page', 1),
            8
        );
        return $this->render('cours/afficheadmin.html.twig', [
            'cours' => $cour,
        ]);
    }

    /**
     * @Route("map",name="admin_map")
     */
    public function mapActions()
    {
        return $this->render('cours/map.html.twig');
    }

    /**
     * @Route("mapUser",name="user_map")
     */
    public function mapActionss()
    {
        return $this->render('cours/map.html.twig');
    }

}
