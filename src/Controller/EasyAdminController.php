<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Form\EmployeeType;
use App\Form\SubdivisionType;
use App\Entity\Employee;
use App\Entity\Subdivision;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EasyAdminController extends AbstractController {
//    /**
//     * @Route("/easy/admin", name="easy_admin")
//     */
//    public function index()
//    {
//        return $this->render('easy_admin/index.html.twig', [
//            'controller_name' => 'EasyAdminController',
//        ]);
//    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index() {
        $em = $this->getDoctrine()->getManager();
        $employees = $em->getRepository(Employee::class)->findAll();
        $subdivisions = $em->getRepository(Subdivision::class)->findAll();
        return $this->render('admin/main.admin.html.twig', [
                    'controller_name' => 'AdminController',
                    'employees' => $employees,
                    'subdivisions' => $subdivisions,
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction() {
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/logout")
     * @throws |RuntimeException
     */
    public function logoutAction() {
        throw new \RuntimeException('"то никогда не должно вызыватьcя напрямую');
    }

    public function configureOptions(OptionsResolver $resolver) {
        // Set the defaults from the DateTimeType we're extending from
        parent::configureOptions($resolver);

        // Override: Go back 20 years and add 20 years
        $resolver->setDefault('years', range(date('Y') - 20, date('Y') + 20));

        // Override: Use an hour range between 08:00AM and 11:00PM
        $resolver->setDefault('hours', range(8, 23));
    }
}
