<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contract;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

}
