<?php

namespace App\Controller;

use App\Entity\Attestation;
use App\Form\AttestationType;
use App\Repository\AttestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/attestation")
 */
class AttestationController extends AbstractController
{
    /**
     * @Route("/", name="attestation_index", methods={"GET"})
     */
    public function index(AttestationRepository $attestationRepository): Response
    {
        return $this->render('attestation/index.html.twig', [
            'attestations' => $attestationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="attestation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $attestation = new Attestation();
        $form = $this->createForm(AttestationType::class, $attestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($attestation);
            $entityManager->flush();

            return $this->redirectToRoute('attestation_index');
        }

        return $this->render('attestation/new.html.twig', [
            'attestation' => $attestation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="attestation_show", methods={"GET"})
     */
    public function show(Attestation $attestation): Response
    {
        return $this->render('attestation/show.html.twig', [
            'attestation' => $attestation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="attestation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Attestation $attestation): Response
    {
        $form = $this->createForm(AttestationType::class, $attestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('attestation_index');
        }

        return $this->render('attestation/edit.html.twig', [
            'attestation' => $attestation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="attestation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Attestation $attestation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attestation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($attestation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('attestation_index');
    }
}
