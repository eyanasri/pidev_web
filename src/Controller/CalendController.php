<?php

namespace App\Controller;

use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendController extends AbstractController
{
    /**
     * @Route("/calend", name="calend")
     */
    public function index(CoursRepository $cours): Response
    {
        $events=$cours->findAll();
        $rdvs=[];
        foreach ($events as $event){
            $rdvs[] = [
                'id'=>$event->getId(),
                'title'=>$event->getNomCompletCours(),

                'start'=>$event->getDateDebutCours()->format('Y-m-d H:i:s'),
                'end'=>$event->getDateFinCours()->format('Y-m-d H:i:s'),
                'backgroundColor'=>$event->getNomAbergeCours(),
                'borderColor'=>'#000000',
                'textColor'=>'#000000',


            ];
        }
        $data = json_encode($rdvs);

        return $this->render('calend/index.html.twig',
            compact('data')
        );
    }

    /**
     * @Route("/calendAdmin", name="calend_Admin")
     */
    public function indexAdmin(CoursRepository $cours): Response
    {
        $events=$cours->findAll();
        $rdvs=[];
        foreach ($events as $event){
            $rdvs[] = [
                'id'=>$event->getId(),
                'title'=>$event->getNomCompletCours(),

                'start'=>$event->getDateDebutCours()->format('Y-m-d H:i:s'),
                'end'=>$event->getDateFinCours()->format('Y-m-d H:i:s'),
                'backgroundColor'=>$event->getNomAbergeCours(),
                'borderColor'=>'#000000',
                'textColor'=>'#000000',


            ];
        }
        $data = json_encode($rdvs);

        return $this->render('calend/adminCalend.html.twig',
            compact('data')
        );
    }
}
