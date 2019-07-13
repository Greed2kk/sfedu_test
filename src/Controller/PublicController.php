<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Subdivision;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="public")
     */
   
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        
        $employees = $em->getRepository(Employee::class)->findAll();
        $subdivisions = $em->getRepository(Subdivision::class)->findAll();
        return $this->render('public/index.html.twig', [
            'controller_name' => 'PublicController',
            'employees' => $employees,
            'subdivisions' => $subdivisions
        ]);
    }
    
    /**
     * @Route("/emploee/moreinfo/{employee_id}", name="more_info_employee")
     */
     public function moreInfoEmployee($employee_id)
    {
      $em = $this->getDoctrine()->getManager();
        
      $employees = $em->getRepository(Employee::class)->findAll();
         return $this->render('public/more_inf_employee.html.twig', [
                'employees' => $employees,
              'employeer_id' => $employee_id
         ]);
     
    } 
    /**
     * @Route("/subdivision/moreinfo/{subdivision_id}", name="more_info_subdivision")
     */
     public function moreInfoSubdivision($subdivision_id)
    {
      $em = $this->getDoctrine()->getManager();
        
      $subdivisions = $em->getRepository(Subdivision::class)->findAll();
         return $this->render('public/more_inf_subdivision.html.twig', [
                'subdivisions' => $subdivisions,
              'subdivision_id' => $subdivision_id
         ]);
     
    }
    
 
}
