<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Teacher;

class PasswordHashSubscriber implements EventSubscriberInterface
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['hashPassword', EventPriorities::PRE_WRITE]
        ];
    }

    public function hashPassword(GetResponseForControllerResultEvent $event) {
        $teacher = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if(!$teacher instanceof Teacher || Request::METHOD_POST !== $method) {
            return;
        }

        $teacher->setPassword(
            $this->passwordEncoder->encodePassword($teacher, $teacher->getPassword())
        );

    }
}
