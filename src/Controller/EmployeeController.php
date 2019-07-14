<?php

namespace App\Controller;

use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
     /**
     * @Route("/emploee/moreinfo/{employee_id}", name="more_info_employee")
     */
     public function moreInfoEmployee($employee_id)
    {
      $em = $this->getDoctrine()->getManager();
        
      $employees = $em->getRepository(Employee::class)->findAll();
         return $this->render('employee/more_inf_employee.html.twig', [
                'employees' => $employees,
              'employeer_id' => $employee_id
         ]);
     
    } 
    
}
