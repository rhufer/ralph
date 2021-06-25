<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;

Class ExceptionLoginListener{

    public function onSymfonyComponentSecurityHttpEventLoginFailureEvent(LoginFailureEvent $event){
        $exception = $event->getException();


        $message = sprintf('Mon erreur est: %s avec le code %s', $exception->getMessage(), $exception->getCode());
        
        $response = new Response();
        $response->setContent($message);

        $event->setResponse($response);
    }
}