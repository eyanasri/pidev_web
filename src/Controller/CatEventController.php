<?php

namespace App\Controller;

use App\Entity\CatEvent;
use App\Form\CatEventType;
use App\Repository\CatEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cat/event")
 */
class CatEventController extends AbstractController
{
    /**
     * @Route("/", name="cat_event_index", methods={"GET"})
     */
    public function index(CatEventRepository $catEventRepository): Response
    {
        return $this->render('cat_event/index.html.twig', [
            'cat_events' => $catEventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cat_event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $catEvent = new CatEvent();
        $form = $this->createForm(CatEventType::class, $catEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($catEvent);
            $entityManager->flush();

            return $this->redirectToRoute('cat_event_index');
        }

        return $this->render('cat_event/new.html.twig', [
            'cat_event' => $catEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cat_event_show", methods={"GET"})
     */
    public function show(CatEvent $catEvent): Response
    {
        return $this->render('cat_event/show.html.twig', [
            'cat_event' => $catEvent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cat_event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CatEvent $catEvent): Response
    {
        $form = $this->createForm(CatEventType::class, $catEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cat_event_index');
        }

        return $this->render('cat_event/edit.html.twig', [
            'cat_event' => $catEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cat_event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CatEvent $catEvent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catEvent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($catEvent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cat_event_index');
    }
}
