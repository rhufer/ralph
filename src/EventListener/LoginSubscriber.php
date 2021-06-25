<?php
namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;


class LoginSubscriber implements EventSubscriberInterface{

    public static function getSubscribedEvents()
    {
        return [
            LoginFailureEvent::class => 'onSymfonyComponentSecurityHttpEventLoginFailureEvent'
        ];
    }

    public function onSymfonyComponentSecurityHttpEventLoginFailureEvent(LoginFailureEvent $event){
        $exception = $event->getException();


        $message = sprintf('Subscriber=Mon erreur est: %s avec le code %s', $exception->getMessage(), $exception->getCode());
        
        $response = new Response();
        $response->setContent($message);

        $event->setResponse($response);
    }
}