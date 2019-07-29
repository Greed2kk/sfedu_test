<?php

namespace App\Controller;

use App\Entity\Subdivision;
use App\Entity\Employee;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SubdivisionType;

class SubdivisionController extends AbstractController {

    /**
     * @Route("/subdivision/moreinfo/{subdivision_id}", name="more_info_subdivision")
     */
    public function moreInfoSubdivision($subdivision_id) {
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

    /**
     * @Route("/sub/del/{subdivision_id}", name="sub_del")
     */
    public function del_sub($subdivision_id) {
        $em = $this->getDoctrine()->getEntityManager();
        $subd = $em->getRepository(Subdivision::class)->find($subdivision_id);
        $em->remove($subd);
        $em->flush();
        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin/subd_add", name="subd_add")
     */
    public function add_subd(Request $request) {
        $subd = new Subdivision();
        $form = $this->createForm(SubdivisionType::class, $subd);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $subd = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $em->persist($subd);
            $em->flush();

            return $this->redirectToRoute('admin'); // поменять   
        }
        return $this->render('subdivision/subdivisionForm.html.twig', [
                    'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/subd_edit/{subdivision}", name="subd_edit")
     */
    public function edit_subd(Request $request, Subdivision $subdivision) {
        $form = $this->createForm(SubdivisionType::class, $subdivision, [
            'action' => $this->generateUrl('subd_edit', [
                'subdivision' => $subdivision->getId()
            ]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $subdivision = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('admin'); // поменять   
        }
        return $this->render('subdivision/subdivisionForm.html.twig', [
                    'form' => $form->createView()
        ]);
    }

}
