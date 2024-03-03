<?php

namespace App\EventSubscriber;

use App\Repository\ConfigProjectRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class ConfigProjectSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly Environment $twig, private readonly ConfigProjectRepository $configProjectRepository)
    {
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('configProject', $this->configProjectRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
