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
    
}
