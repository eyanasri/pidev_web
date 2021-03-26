<?php

namespace App\Controller;

use App\Entity\Meet;
use App\Form\MeetType;
use App\Repository\MeetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/meet")
 */
class MeetController extends AbstractController
{
    /**
     * @Route("/", name="meet_index", methods={"GET"})
     */
    public function index(MeetRepository $meetRepository): Response
    {
        return $this->render('meet/index.html.twig', [
            'meets' => $meetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="meet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $meet = new Meet();
        $form = $this->createForm(MeetType::class, $meet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($meet);
            $entityManager->flush();

            return $this->redirectToRoute('meet_index');
        }

        return $this->render('meet/new.html.twig', [
            'meet' => $meet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="meet_show", methods={"GET"})
     */
    public function show(Meet $meet): Response
    {
        return $this->render('meet/show.html.twig', [
            'meet' => $meet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="meet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Meet $meet): Response
    {
        $form = $this->createForm(MeetType::class, $meet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('meet_index');
        }

        return $this->render('meet/edit.html.twig', [
            'meet' => $meet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="meet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Meet $meet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$meet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($meet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('meet_index');
    }
}
