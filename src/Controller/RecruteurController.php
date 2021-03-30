<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\OffreType;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Twilio\Rest\Client as Client;

/**
 * @Route("/recruteur")
 */
class RecruteurController extends AbstractController
{
    /**
     * @Route("/aff", name="recruteur_index", methods={"GET"})
     */
    public function index(OffreRepository $offreRepository): Response
    {
        return $this->render('Frontend/recruteur_index.html.twig', [
            'offres' => $offreRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="recruteur_new", methods={"GET","POST"})
     */
    public function new(Request $request, \Swift_Mailer $mailer ): Response
    {
        $offre = new Offre();
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $offre->setLongitude($request->request->get('a'));
            $offre->setAlg($request->request->get('b'));

            $entityManager->persist($offre);

            //SMS
            $sid = 'AC38cc377cc829c9e68474bc40f3fb1dde';
            $token = 'c438b563146069657faefd35736deefc';
            $client = new Client($sid, $token);
            $client->messages->create(
            // the number you'd like to send the message to

                '+21654137262',
                [
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => '+12103219695',
                    // the body of the text message you'd like to send
                    'body' => 'Bonjour votre offre d emploi a ete ajoute avec succes!'
                ]
            );

            //mailing
            $message = (new \Swift_Message('email offre d emploi '))
                ->setFrom('reservations.jobcore@gmail.com')
                ->setTo($offre->getEmail())
                ->setBody('Bonjour votre offre d emploi a ete ajoute avec succes');
            $mailer->send($message);

            $entityManager->flush();

            return $this->redirectToRoute('recruteur_index');
        }

        return $this->render('Frontend/recruteur_new.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/edit", name="recruteur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Offre $offre): Response
    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recruteur_index');
        }

        return $this->render('Frontend/recruteur_edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="recruteur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Offre $offre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recruteur_index');
    }
    /**
     * @Route("/{id}", name="recruteur_show", methods={"GET"})
     */
    public function show(Offre $offre): Response
    {
        return $this->render('Frontend/recruteur_show.html.twig', [
            'offre' => $offre,
        ]);
    }

}
