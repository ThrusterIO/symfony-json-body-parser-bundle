<?php

namespace Thruster\Bundle\SymfonyJsonBodyParserBundle;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class RequestListener
 *
 * @package Thruster\Bundle\SymfonyJsonBodyParserBundle
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class RequestListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['onRequest', 4096]
        ];
    }

    public function onRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if (false === strpos($request->getContentType(), 'json')) {
            return;
        }

        if ($request->attributes->has('_ignore_json_body')) {
            return;
        }

        $content = $request->getContent(false);

        if (empty($content)) {
            return;
        }

        if (false === ($params = $this->parseJson($content))) {
            $event->setResponse(new JsonResponse(['error' => 'Unable to parse JSON'], 400));
            return;
        }

        $request->request->replace($params);
    }

    private function parseJson($content)
    {
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        return $data;
    }
}
