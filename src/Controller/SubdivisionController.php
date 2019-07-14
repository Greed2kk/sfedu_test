<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SubdivisionController extends AbstractController
{
    /**
     * @Route("/subdivision", name="subdivision")
     */
    public function index()
    {
        return $this->render('subdivision/index.html.twig', [
            'controller_name' => 'SubdivisionController',
            
        ]);
    }
    
    
    
    
    
    
}
