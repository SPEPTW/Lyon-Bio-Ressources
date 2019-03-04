<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MailchimpController extends AbstractController
{
    /**
     * @Route("/mailchimp", name="mailchimp")
     */
    public function index()
    {
        return $this->render('mailchimp/index.html.twig', [
            'controller_name' => 'MailchimpController',
        ]);
    }
}
