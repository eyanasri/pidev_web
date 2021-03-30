<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Entity\Users;
use App\Form\OffreType;
use App\Repository\CategorieRepository;
use App\Repository\OffreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Yamilovs\Bundle\SmsBundle\Service\ProviderManager;
use Yamilovs\Bundle\SmsBundle\Sms\Sms;
use Twilio\Rest\Client as Client;

/**
 * @Route("/offre")
 */
class OffreController extends AbstractController
{
    /**
     * @Route("/", name="offre_index", methods={"GET"})
     */
    public function index(OffreRepository $offreRepository): Response
    {
        return $this->render('offre/index.html.twig', [
            'offres' => $offreRepository->findAll(),
        ]);
    }
    /**
     * @Route("/frontend/affichage", name="frontend_offre_index", methods={"GET"})
     */
    public function list(OffreRepository $offreRepository, Request $request, PaginatorInterface $paginator): Response
    {

        $articles = $paginator->paginate(
            $offreRepository->findAll(),
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('Frontend/affichage.html.twig', [
            'offres' => $articles,
        ]);
    }
    /**
     * @Route("/{id}/frontend/affichage", name="frontend_offre_show", methods={"GET"})
     */
    public function affichage(Offre $offre): Response
    {
        return $this->render('Frontend/job_details.html.twig', [
            'offre' => $offre,
        ]);
    }

    /**
     * @Route("/new", name="offre_new", methods={"GET","POST"})
     */
    public function new(Request $request , \Swift_Mailer $mailer): Response
    {
        $offre = new Offre();
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $offre->setLongitude($request->request->get('a'));
            $offre->setAlg($request->request->get('b'));

            $entityManager->persist($offre);

              //  $sms = new Sms('22437262', 'The cake is a lie');
               // $provider = $providerManager->getProvider('ferouk');

               // $provider->send($sms);
               $sid = 'AC38cc377cc829c9e68474bc40f3fb1dde';
               $token = 'c438b563146069657faefd35736deefc';
               $client = new Client($sid, $token);
               
               // Use the client to do fun stuff like send text messages!
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
            $message = (new \Swift_Message('email offre d emploi '))
                ->setFrom('reservations.jobcore@gmail.com')
                ->setTo($offre->getEmail())
                ->setBody('Bonjour votre offre d emploi a ete ajoute avec succes');
            $mailer->send($message);
            $entityManager->flush();

            return $this->redirectToRoute('offre_index');
        }

        return $this->render('offre/new.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Stat", name="Stat")
     */
    public function stat(CategorieRepository $categRepo)
    {
        $categ = $categRepo->findAll();

        $categNom = [];
        $categColor = [];
        $categCount = [];

        foreach ($categ as $categorie){
            $categNom[] = $categorie->getNomCategorie();
            $categColor[] = $categorie->getColor();
            $categCount[] = count($categorie->getOffres());

        }

        return $this->render('offre/stats.html.twig', [
            'categNom' => json_encode($categNom),
            'categColor' => json_encode($categColor),
            'categCount' => json_encode($categCount)
        ]);
    }

    /**
     * @Route("triasc", name="triasc")
     */
    public function triasc(OffreRepository $repo, Request $request, PaginatorInterface $paginator)
    {

        $articles = $paginator->paginate(
            $repo->triasc(),
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('Frontend/affichage.html.twig', [
            'offres' => $articles,
        ]);
    }


    /**
     * @Route("/{id}", name="offre_show", methods={"GET"})
     */
    public function show(Offre $offre): Response
    {
        return $this->render('offre/show.html.twig', [
            'offre' => $offre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="offre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Offre $offre): Response
    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offre_index');
        }

        return $this->render('offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="offre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Offre $offre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('offre_index');
    }

    /**
     * @Route("tridesc",name="tridesc")
     */
    public function tridesc(OffreRepository $repo, Request $request, PaginatorInterface $paginator)
    {

        $articles = $paginator->paginate(
            $repo->tridesc(),
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('Frontend/affichage.html.twig', [
            'offres' => $articles,
        ]);
    }

    /**
     * @Route("trisalaireasc",name="trisalaireasc")
     */
    public function trisalasc(OffreRepository $repo, Request $request, PaginatorInterface $paginator)
    {

        $articles = $paginator->paginate(
            $repo->trisalasc(),
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('Frontend/affichage.html.twig', [
            'offres' => $articles,
        ]);
    }

    /**
     * @Route("trisalairedesc",name="trisalairedesc")
     */
    public function trisaldesc(OffreRepository $repo, Request $request, PaginatorInterface $paginator)
    {

        $articles = $paginator->paginate(
            $repo->trisaldesc(),
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('Frontend/affichage.html.twig', [
            'offres' => $articles,
        ]);
    }
    /**
     * @Route("favoris", name="offre_favoris", methods={"GET"})
     */
    public function favoris(OffreRepository $offreRepository ,Request $request, PaginatorInterface $paginator): Response
    {
        $articles = $paginator->paginate(
            $offreRepository->findBy(array('favoris' => '1' ) ),
            $request->query->getInt('page', 1),
            4
        );
        $offreRepository->findBy(array('favoris' => '1' ) );
        return $this->render('Frontend/favoris.html.twig', [
            'offres' => $articles
        ]);

    }
    /**
     * @Route("/{id}/setfavoris", name="offre_setfavoris" , methods={"GET"})
     */
    public function setfavoris(OffreRepository $offreRepository , Offre $offre): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

        $offre->setFavoris(1);
        $entityManager->persist($offre);
        $entityManager->flush();

        return $this->redirectToRoute('offre_favoris',[
            'offres' => $offreRepository->findBy(array('favoris' => '1' ) )
        ]);

    }
    /**
     * @Route("/{id}/supfavoris", name="offre_supfavoris" , methods={"GET"})
     */
    public function supfavoris(OffreRepository $offreRepository , Offre $offre): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

        $offre->setFavoris(0);
        $entityManager->persist($offre);
        $entityManager->flush();

        return $this->redirectToRoute('offre_favoris',[
            'offres' => $offreRepository->findBy(array('favoris' => '1' ) )
        ]);
    }
    /**
     * @Route("/{id}/apply", name="offre_apply" , methods={"GET","POST"})
     */
    public function apply(OffreRepository $offreRepository ,Users $user ,Offre $offre, Request $request): Response
    {
        $IdOffre = $offre->getId();
        $IdUser = $user->getId();
    }

}
