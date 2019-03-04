<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Welp\MailchimpBundle\Event\SubscriberEvent;
use Welp\MailchimpBundle\Subscriber\Subscriber;

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

    public function newUser(User $user)
    {
        $subscriber = new Subscriber($user->getEmail(), [
            'FIRSTNAME' => $user->getFirstname(),
        ], [
            'language' => 'fr'
        ]);

        $this->container->get('event_dispatcher')->dispatch(
            SubscriberEvent::EVENT_SUBSCRIBE,
            new SubscriberEvent( '05c0809975', $subscriber)
        );
    }

    public function unsubscribeUser(User $user)
    {
        $subscriber = new Subscriber($user->getEmail());

        $this->container->get('event_dispatcher')->dispatch(
            SubscriberEvent::EVENT_UNSUBSCRIBE,
            new SubscriberEvent( '05c0809975', $subscriber)
        );
    }

    public function updateUser(User $user)
    {
        $subscriber = new Subscriber($user->getEmail(), [
            'FIRSTNAME' => $user->getFirstname(),
            'LASTNAME' => $user->getFirstname(),
        ], [
            'language' => 'en'
        ]);

        $this->container->get('event_dispatcher')->dispatch(
            SubscriberEvent::EVENT_UPDATE,
            new SubscriberEvent( '05c0809975', $subscriber)
        );
    }

    public function deleteUser(User $user)
    {
        $subscriber = new Subscriber($user->getEmail());

        $this->container->get('event_dispatcher')->dispatch(
            SubscriberEvent::EVENT_DELETE,
            new SubscriberEvent( '05c0809975', $subscriber)
        );
    }
}
