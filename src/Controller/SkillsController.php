<?php

namespace App\Controller;

use App\Entity\Skills;
use App\Form\SkillsType;
use App\Repository\SkillsRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/skills" , name="skills_")
 */
class SkillsController extends AbstractController
{

    /**
     * @param SkillsRepository $repository
     * @return Response
     * @Route("/affiche" , name="affiche")
     */
    public function Affiche (SkillsRepository $repository){
        #$repo->$this->getDoctrine()->getRepository(Skills::class);
        $skills=$repository->findall();
        return $this->render('skills/Affiche.html.twig',
            ['skills'=>$skills]);

    }
    /**
     * @Route("/Supprimer/{id}",name="supprimer")
     */
    function Delete($id, SkillsRepository $repository ) {
        $skills=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($skills);
        $em->flush();
        return $this->$this->redirectToRoute('skills_affiche');


    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/ajouter", name="ajouter")
     */
    function Add(\Symfony\Component\HttpFoundation\Request $request){
        $skills=new Skills();
        $form=$this->createForm(SkillsType::class,$skills);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($skills);
            $em->flush();
            return $this->redirectToRoute("skills_affiche");
        }
        return $this->render('skills/Add.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    /**
     * @param $id
     * @param SkillsRepository $repo
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/modifier/{id}",name="modifier")
     */
    public function update($id, SkillsRepository  $repo, \Symfony\Component\HttpFoundation\Request $request)
    {
        $materiel = $repo->find($id);
        $form = $this->createForm(SkillsType::class, $materiel);
        $form->add("update", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("skills_affiche");
        }
        return $this->render("skills/updateS.html.twig", [
            "form" => $form->createView()
        ]);
    }

}

