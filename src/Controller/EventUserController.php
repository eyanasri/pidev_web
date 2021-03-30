<?php

namespace App\Controller;
use App\Entity\Users;
use App\Entity\ReservationEvent;
use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/browse_event")
 */

class EventUserController extends AbstractController
{
    /**
     * @Route("/recherche", name="recherche_event")
     */
    public function searchAction(Request $request)
    {

        $data = $request->request->get('search');


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT e FROM App\Entity\Event e WHERE e.nom    LIKE :data')
            ->setParameter('data', '%'.$data.'%');


        $events = $query->getResult();

        return $this->render('event_user/index.html.twig', [
            'events' => $events,
        ]);

    }

    /**
     * @Route("/tri", name="sort_event_user")
     */
    public function TriAction(Request $request)
    {




        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT e FROM App\Entity\Event e
    ORDER BY e.nom ASC');



        $events = $query->getResult();

        return $this->render('event_user/index.html.twig', array(
            'events' => $events));

    }

    /**
     * @Route("/", name="event_index_user", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event_user/index.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}", name="event_show_user", methods={"POST","GET"})
     */
    public function show(Event $event): Response
    {

        if (isset($_POST["submit_address"]))
        {
            $address = $_POST["address"];
            $address = str_replace(" ", "+", $address);
            ?>

            <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed"></iframe>

            <?php
        }
        //return $this->render('event/map.html.twig');

        return $this->render('event_user/show.html.twig', [
            'event' => $event,
        ]);
    }







    /**
     * @Route("/tri/date", name="sort_event_date")
     */
    public function TriActionDate(Request $request)
    {




        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT e FROM App\Entity\Event e
    ORDER BY e.date ASC');



        $events = $query->getResult();

        return $this->render('event_user/index.html.twig', array(
            'events' => $events));

    }
}
