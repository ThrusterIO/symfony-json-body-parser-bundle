<?php

namespace Thruster\Bundle\SymfonyJsonBodyParserBundle\Tests;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Thruster\Bundle\SymfonyJsonBodyParserBundle\RequestListener;

/**
 * Class RequestListenerTest
 *
 * @package Thruster\Bundle\SymfonyJsonBodyParserBundle\Tests
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class RequestListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testSubscribedEvemts()
    {
        $this->assertArrayHasKey(KernelEvents::REQUEST, RequestListener::getSubscribedEvents());
    }

    public function testInvalidContentType()
    {
        $request = new Request();
        $request->headers->set('Content-Type', 'text/html');

        $listener = new RequestListener();

        $this->assertNull($listener->onRequest($this->getEvent($request)));
    }

    public function testIgnoreJsonBodyAttribute()
    {
        $request = new Request();
        $request->headers->set('Content-Type', 'application/json');
        $request->attributes->set('_ignore_json_body', true);

        $listener = new RequestListener();

        $this->assertNull($listener->onRequest($this->getEvent($request)));
    }

    public function testEmptyBody()
    {
        $request = new Request();
        $request->headers->set('Content-Type', 'application/json');

        $listener = new RequestListener();

        $this->assertNull($listener->onRequest($this->getEvent($request)));
    }

    public function testInvalidBody()
    {
        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            [],
            'asdasdasdasdasd'
        );

        $request->headers->set('Content-Type', 'application/json');

        $listener = new RequestListener();

        $event = $this->getEvent($request);

        $this->assertNull($listener->onRequest($event));
        $response = $event->getResponse();

        $this->assertNotNull($response);
        $this->assertInstanceOf('\Symfony\Component\HttpFoundation\JsonResponse', $response);
        $this->assertSame(400, $response->getStatusCode());
    }


    public function testParser()
    {
        $request = new Request(
            [],
            [],
            [],
            [],
            [],
            [],
            '{"foo": "bar"}'
        );

        $request->headers->set('Content-Type', 'application/json');

        $listener = new RequestListener();

        $event = $this->getEvent($request);

        $this->assertNull($listener->onRequest($event));
        $this->assertTrue($request->request->has('foo'));
        $this->assertSame('bar', $request->request->get('foo'));
    }

    private function getEvent(Request $request)
    {
        return new GetResponseEvent(
            $this->getMockForAbstractClass('\Symfony\Component\HttpKernel\HttpKernelInterface'),
            $request,
            HttpKernelInterface::MASTER_REQUEST
        );
    }
}
