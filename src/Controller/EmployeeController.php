<?php

namespace App\Controller;

use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    /**
     * @Route("/employee", name="employee")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        
        $employees = $em->getRepository(Employee::class)->findAll();
        
        return $this->render('employee/index.html.twig', [
            'controller_name' => 'EmployeeController',
            'employees' => $employees
        ]);
    }
    
    
    
    
    
}
