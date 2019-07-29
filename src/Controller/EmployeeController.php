<?php

namespace App\Controller;

use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EmployeeType;

class EmployeeController extends AbstractController {

    /**
     * @Route("/emploee/moreinfo/{employee_id}", name="more_info_employee")
     */
    public function moreInfoEmployee($employee_id) {
        $em = $this->getDoctrine()->getManager();
        $employees = $em->getRepository(Employee::class)->findAll();
        return $this->render('employee/more_inf_employee.html.twig', [
                    'employees' => $employees,
                    'employeer_id' => $employee_id
        ]);
    }

    /**
     * @Route("/emp/del/{employee_id}", name="emp_del")
     */
    public function del_emp($employee_id) {
        $em = $this->getDoctrine()->getEntityManager();
        $empl = $em->getRepository(Employee::class)->find($employee_id);
        $em->remove($empl);
        $em->flush();
        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin/emp_add", name="emp_add")
     */
    public function add_emp(Request $request) {
        $emp = new Employee();

        $form = $this->createForm(EmployeeType::class, $emp, [
            'action' => $request->getRequestUri()
        ]);
        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getId()));
            var_dump($form->isSubmitted()); //FALSE 
            if ($form->isSubmitted() && $form->isValid()) {
                $emp = $form->getData();
                $emp->setUpdated_at(new \DateTime('now'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($emp);
                $em->flush();
                return $this->redirectToRoute('admin'); // поменять   
            }
        }
        return $this->render('employee/employeeForm.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/emp_edit/{employee}", name="emp_edit")
     */
    public function edit_emp(Request $request, Employee $employee) {
        $form = $this->createForm(EmployeeType::class, $employee, [
            'action' => $this->generateUrl('emp_edit', [
                'employee' => $employee->getId()
            ]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $employee = $form->getData();
            $employee->setUpdated_at(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('admin'); // поменять   
        }
        return $this->render('employee/employeeForm.html.twig', [
                    'form' => $form->createView()
        ]);
    }

}
