<?php

namespace App\Controller;

use App\Entity\Cours;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route("/api/{id}/edit", name="api_event_edit" , methods={"PUT"})
     */
    public function majEvent(?Cours $cours,Request $request): Response
    {
        $donnees =json_decode($request->getContent());
        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->end) && !empty($donnees->end) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor)


        ){
            $code=200;

            if(!$cours){
                $cours = new cours;
                $code=201;
            }
            $cours->setNomCompletCours($donnees->title);
            $cours->setNomAbergeCours($donnees->backgroundColor);
            $cours->getDateDebutCours(new DateTime($donnees->start) );
            $cours->setDateFinCours(new DateTime($donnees->end));


            $em=$this->getDoctrine()->getManager();
            $em->persist($cours);
            $em->flush();

            return new Request('OK',$code);

        }else{
            return new Response('Donnée incomplétes',404);
        }
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
