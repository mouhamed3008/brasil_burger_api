<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ValidateAccountEventSubscriber implements EventSubscriberInterface
{
    public function onEncodePassword(Request $event): void
    {
        dd($event);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Request::class => 'onEncodePassword'

        ];
    }


    public function onKernelRequest(RequestEvent $event)
    {
        dump($event->getRequest()->request)
;        if ($event->getRequest()->request->get('password')) {
            dd('ok');
        }

    }


}
