<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Subdivision;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EasyAdminController extends AbstractController
{
    /**
     * @Route("/easy/admin", name="easy_admin")
     */
    public function index()
    {
        return $this->render('easy_admin/index.html.twig', [
            'controller_name' => 'EasyAdminController',
        ]);
    }
        /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
       return $this->render('security/login.html.twig');
    }
    
    /**
     * @Route("/logout")
     * @throws |RuntimeException
     */
    public function logoutAction()
    {
        throw new \RuntimeException('"то никогда не должно вызыватьcя напрямую');
    }
        
}
