<?php

namespace App\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LogSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
            KernelEvents::RESPONSE => 'onKernelResponse'
        ];
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $test = 1;
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        $test = 1;
    }
}