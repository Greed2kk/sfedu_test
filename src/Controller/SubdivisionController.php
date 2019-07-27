<?php

namespace App\Controller;

use App\Entity\Subdivision;
use App\Entity\Employee;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class SubdivisionController extends AbstractController
{
     /**
     * @Route("/subdivision/moreinfo/{subdivision_id}", name="more_info_subdivision")
     */
     public function moreInfoSubdivision($subdivision_id)
    {
      $em = $this->getDoctrine()->getManager();

        $sub = $this->getDoctrine()
                ->getRepository(Subdivision::class)
                ->find($subdivision_id);   
        $empId = $sub->getFkDir()->getId();
        $empFio = $sub->getFkDir()->getFio();
       
        $subdivisions = $em->getRepository(Subdivision::class)->findAll();
      $employees = $em->getRepository(Employee::class)->findAll(); 
//      $em_n_dir = $em->getRepository(Subdivision::class)->findAll();     
         return $this->render('subdivision/more_inf_subdivision.html.twig', [
                'subdivisions' => $subdivisions,
              'subdivision_id' => $subdivision_id,
              'empId' => $empId,
              'empFio' => $empFio
         ]);
    }  
}
