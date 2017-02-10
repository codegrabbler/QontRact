<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contract;
use AppBundle\Form\ContractCustomerType;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CustomerController extends Controller
{
    /**
     * @Route("/contractImport/{token}")
     * @Secure(roles="ROLE_USER")
     */
    public function contractImportAction($token)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        /** @var Contract $contract */
        $contract = $this->getDoctrine()->getRepository(Contract::class)->findOneByToken($token);
        $user = $this->getUser();
        $contract->setOwner($user);
        $this->getDoctrine()->getManager()->persist($contract);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success', "Vertrag gespeichert");
        return $this->redirect($this->generateUrl('app_customer_index'));
    }

    /**
     * @Route("/index")
     * @Template()
     */
    public function indexAction()
    {
        $contracts = $this->getDoctrine()->getRepository(Contract::class)->findByOwner($this->getUser());
        return [
            'contracts' => $contracts
        ];
    }

    /**
     * @Route("/contractView/{id}")
     * @Template()
     */
    public function contractViewAction($id)
    {
        $contract = $this->getDoctrine()->getRepository(Contract::class)->find($id);
        return [
            'contract' => $contract
        ];
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
            $contract->setOwner($this->getUser());
        }
        $form = $this->createForm(ContractCustomerType::class, $contract);

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
}
