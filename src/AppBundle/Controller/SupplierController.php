<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contract;
use AppBundle\Form\ContractType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SupplierController extends Controller
{
    /**
     * @Route("/index")
     * @Template()
     */
    public function indexAction()
    {
        $contractRepository = $this->getDoctrine()->getRepository(Contract::class);
        $contracts = $contractRepository->findAll();
        return ['contracts' => $contracts];
    }

    /**
     * @Route("/contractEdit/{id}")
     * @Template()
     */
    public function contractEditAction(Request $request, $id = null)
    {
        $contractRepository = $this->getDoctrine()->getRepository(Contract::class);
        if ($id) {
            $contract = $contractRepository->find($id);
        } else {
            $contract = new Contract();
        }
        $form = $this->createForm(ContractType::class, $contract);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($contract);
                $manager->flush();
                return $this->redirect($this->generateUrl('app_supplier_index'));
            }

        }

        return [
            'form' => $form->createView()
        ];
    }
    /**
     * @Route("/contractShow/{id}")
     * @Template()
     */
    public function contractShowAction($id)
    {
        $contract = $this->getDoctrine()->getRepository(Contract::class)->find($id);
        return(
            ['contract' => $contract]
        );
    }
}
