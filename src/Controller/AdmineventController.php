<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use PhpParser\Node\Expr\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/adminevent")
 */
class AdmineventController extends AbstractController
{


    /**
     * @Route("/tri", name="sort")
     */
    public function TriAction(Request $request)
    {




        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT e FROM App\Entity\Event e
    ORDER BY e.nom ASC');



        $events = $query->getResult();

        return $this->render('event/indexback.html.twig', array(
            'events' => $events));

    }






    /**
     * @Route("/recherche", name="recherche")
     */
    public function searchAction(Request $request)
    {

        $data = $request->request->get('search');


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT e FROM App\Entity\Event e WHERE e.nom    LIKE :data')
            ->setParameter('data', '%'.$data.'%');


        $events = $query->getResult();

        return $this->render('event/indexback.html.twig', [
            'events' => $events,
            ]);

    }

    /**
     * @Route("/", name="admin_event", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/indexback.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="event_new_admin", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('admin_event');
        }

        return $this->render('event/newback.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="event_show_admin", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('event/showback.html.twig', [
            'event' => $event,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="event_edit_admin", methods={"GET","POST"})
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_event');
        }

        return $this->render('event/editback.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_delete_admin", methods={"DELETE"})
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_event');
    }









}
