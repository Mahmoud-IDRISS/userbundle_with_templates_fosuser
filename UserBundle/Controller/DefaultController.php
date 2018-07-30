<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

    /**
     * @Route("/user/test", name="user_test")
     */
    public function usertestAction()
    {
        return $this->render('@User/Default/index.html.twig');
    }

}
