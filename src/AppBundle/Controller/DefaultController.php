<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contract;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller implements TranslationContainerInterface
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/token/{token}", name="token")
     * @Template()
     */
    public function tokenAction($token)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $contract = $this->getDoctrine()->getRepository(Contract::class)->findByToken($token);

        return [
            'contract' => $contract
        ];
    }

    /**
     * Returns an array of messages.
     *
     * @return array<Message>
     */
    public static function getTranslationMessages()
    {
        return [
            //new JMS\TranslationBundle\Model\Message('key', 'domain')
        ];
    }
}
