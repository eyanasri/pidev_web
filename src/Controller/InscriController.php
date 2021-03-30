<?php

namespace App\Controller;

use App\Entity\Inscri;
use App\Form\InscriType;
use App\Repository\InscriRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inscri")
 */
class InscriController extends AbstractController
{
    /**
     * @Route("/", name="inscri_index", methods={"GET"})
     */
    public function index(InscriRepository $inscriRepository): Response
    {
        return $this->render('inscri/index.html.twig', [
            'inscris' => $inscriRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="inscri_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $inscri = new Inscri();
        $form = $this->createForm(InscriType::class, $inscri);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inscri);
            $entityManager->flush();

            return $this->redirectToRoute('inscri_index');
        }

        return $this->render('inscri/new.html.twig', [
            'inscri' => $inscri,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inscri_show", methods={"GET"})
     */
    public function show(Inscri $inscri): Response
    {
        return $this->render('inscri/show.html.twig', [
            'inscri' => $inscri,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="inscri_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Inscri $inscri): Response
    {
        $form = $this->createForm(InscriType::class, $inscri);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inscri_index');
        }

        return $this->render('inscri/edit.html.twig', [
            'inscri' => $inscri,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inscri_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Inscri $inscri): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscri->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inscri);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inscri_index');
    }
}
