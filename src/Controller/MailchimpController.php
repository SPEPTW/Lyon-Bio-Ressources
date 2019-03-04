<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;

use App\Entity\User;



class MailchimpController extends Controller
{

    protected $container;

    public function __construct(ContainerInterface $ci) {
        $this->container = $ci;
    }

    public function newUser(User $user)
    {
        $subscriber = new Subscriber($user->getEmail(), [
            'FIRSTNAME' => $user->getUsername(),
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
            'FIRSTNAME' => $user->getUsername(),
        ], [
            'language' => 'fr'

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
