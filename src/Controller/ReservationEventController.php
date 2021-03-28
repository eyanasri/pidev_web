<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\ReservationEvent;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;


class ReservationEventController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation_admin", methods={"GET"})
     */
    public function inde(UsersRepository $usersRepository): Response
    {
        return $this->render('reservation_event_admin/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/list/{id}",name="list")
     */
    public function list($id)
    {
        $reservation = $this->getDoctrine()->getRepository(ReservationEvent::class)->findAll();
        $client = $this->getDoctrine()->getRepository(Users::class)->find($id);
        $clients = $this->getDoctrine()->getRepository(Users::class)->findAll();
        $Events = $this->getDoctrine()->getRepository(Event::class)->findAll();



        return $this->render('reservation_event/index.html.twig',
            [
                'reservation'=>$reservation,
                'Event' => $Events,
                'client'=>$client,'clients'=>$clients,
            ]);
    }


    /**
     * @Route("/new/{id}/{id1}", name="new")
     * Method({"GET", "POST"})
     */
    public function new(Request $request,$id,$id1)
    {
        $reservation = new ReservationEvent();
        $reservation->setIdclient($id);
        $reservation->setIdevent($id1);
        $res1 = $this->getDoctrine()->getRepository(ReservationEvent::class)->findOneBy([
                'idclient' => $reservation->getIdclient(),
                'idevent' => $reservation->getIdevent(),
            ]);
        if (!empty($res1))
        {
            $this->get('session')->getFlashBag()->add(
                'message',
                'Vous avez deja reserver à cet evenment'
            );
            return $this->redirectToRoute('list',array('id' => $reservation->getIdclient()));
        }

        $entityManager = $this->getDoctrine()->getManager();


        $event = $this->getDoctrine()->getRepository(Event::class)->find($reservation->getIdevent());
        if ($event->getCapacite() == 0)
        {
            $this->get('session')->getFlashBag()->add(
                'message',
                'l evenement est deja au complet'
            );

            return $this->redirectToRoute('list',array('id' => $reservation->getIdclient()));

        } else {
            $event->setCapacite($event->getCapacite() - 1);
            $entityManager->persist($event);
            $entityManager->flush();


            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('list',array('id' => $reservation->getIdclient()));
        }

    }
    /**
     * @Route("/delete/{id}",name="delete")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $reservation = $this->getDoctrine()->getRepository(ReservationEvent::class)->find($id);
        $pro = $reservation->getIdclient();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($reservation);
        $entityManager->flush();

        $event = $this->getDoctrine()->getRepository(Event::class)->find($reservation->getIdevent());
        $event->setCapacite($event->getCapacite() + 1);
        $entityManager->persist($event);
        $entityManager->flush();

        $response = new Response();
        $response->send();

        return $this->redirectToRoute('list',array('id' => $pro));
    }



}