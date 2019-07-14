<?php

namespace App\Controller;

use App\Entity\Subdivision;
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
        
      $subdivisions = $em->getRepository(Subdivision::class)->findAll();
         return $this->render('subdivision/more_inf_subdivision.html.twig', [
                'subdivisions' => $subdivisions,
              'subdivision_id' => $subdivision_id
         ]);
     
    }  
}
