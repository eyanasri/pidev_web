<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\ReservationEvent;
use App\Entity\Users;
use App\Repository\EventRepository;
use App\Repository\ReservationEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendrierController extends AbstractController
{
    /**
     * @Route("/calendrier/{id}", name="calendrier")
     */
    public function index(ReservationEventRepository $liste_events, $id): Response
    {
        $reservation = $this->getDoctrine()->getRepository(ReservationEvent::class)->findAll();
        $client = $this->getDoctrine()->getRepository(Users::class)->find($id);
        $clients = $this->getDoctrine()->getRepository(Users::class)->findAll();
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();

        $rdvs = [];
        foreach ($reservation as $e) {
            foreach ($events as $event) {
                if ($event->getId() == $e->getIdevent())
                $rdvs [] = [
                    'id' => $event->getId(),
                    'date' => $event->getDate()->format('Y-m-d'),
                    'title' => $event->getNom(),
                    'lieu' => $event->getLieu(),
                    'description' => $event->getDescription(),

                ];
            }
        }
        $data = json_encode($rdvs);
        return $this->render('calendrier/index.html.twig', compact('data'));
    }
}
