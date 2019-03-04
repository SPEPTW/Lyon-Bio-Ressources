<?php

namespace App\Controller\Lbr;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\MailchimpController;
use DrewM\MailChimp\MailChimp;

class UserController extends AbstractController
{


    private $mc;

    public function __construct(MailchimpController $mc) {
        $this->mc = $mc;
    }
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
