<?php

namespace App\Controller;

use App\Entity\Inscrip;
use App\Form\InscripType;
use App\Repository\InscripRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inscrip")
 */
class InscripController extends AbstractController
{
    /**
     * @Route("/", name="inscrip_index", methods={"GET"})
     */
    public function index(InscripRepository $inscripRepository): Response
    {
        return $this->render('inscrip/index.html.twig', [
            'inscrips' => $inscripRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="inscrip_new", methods={"GET","POST"})
     */
    public function new(Request $request, \Swift_Mailer $mailer): Response
    {
        $inscrip = new Inscrip();
        $form = $this->createForm(InscripType::class, $inscrip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inscrip);
            $entityManager->flush();


            ////////////////envoyer des mails
            $message = (new \Swift_Message('Nouveau Inscription!'))
                ->setFrom('mejrialoulou74@gmail.com')
                ->setTo($inscrip->getCourEmail())
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'inscrip/registration.html.twig',
                        ['name' => $form,
                            'inscrip' => $inscrip,]
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);
            $this->addFlash('message','Vous aller recevoir un mail');
///////////////////////////

            return $this->redirectToRoute('inscrip_index');
        }

        return $this->render('inscrip/new.html.twig', [
            'inscrip' => $inscrip,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inscrip_show", methods={"GET"})
     */
    public function show(Inscrip $inscrip): Response
    {
        return $this->render('inscrip/show.html.twig', [
            'inscrip' => $inscrip,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="inscrip_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Inscrip $inscrip): Response
    {
        $form = $this->createForm(InscripType::class, $inscrip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inscrip_index');
        }

        return $this->render('inscrip/edit.html.twig', [
            'inscrip' => $inscrip,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inscrip_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Inscrip $inscrip): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscrip->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inscrip);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inscrip_index');
    }
}
