<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractServer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends Controller
{
    /**
     * @Route("/tesstAjax/{id}", options={"expose" = true})
     */
    public function sampleAjaxAction($id)
    {
        $result = [
            'success' => true,
            'data' => [
            ]
        ];
        return new JsonResponse($result);
    }

}
