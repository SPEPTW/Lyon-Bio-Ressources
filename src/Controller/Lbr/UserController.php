<?php

namespace App\Controller\Lbr;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/lbr/user", name="lbr_user")
     */
    public function index()
    {
        return $this->render('lbr/user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
