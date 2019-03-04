<?php

namespace App\Newsletter;

use Welp\MailchimpBundle\Provider\ProviderInterface;
use Welp\MailchimpBundle\Subscriber\Subscriber;
use App\Repository\UserRepository;
use App\Entity\User;

class NewsletterSubscriberProvider implements ProviderInterface
{
    // these tags should match the one you added in MailChimp's backend
    const TAG_NICKNAME =           'NICKNAME';

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getSubscribers()
    {
        $users = $this->userRepository->findSubscribers();

        $subscribers = array_map(function (User $user) {
                $subscriber = new Subscriber($user->getEmail(), [
                self::TAG_NICKNAME => $user->getUsername(),
            ], [
                'language'   => 'fr',
                'email_type' => 'html'
            ]);

            return $subscriber;
        }, $users);

        return $subscribers;
    }
}

