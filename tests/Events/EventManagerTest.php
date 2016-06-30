<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Events;

use Fungio\GoogleMap\Events\EventManager;

/**
 * Event manager test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Events\EventManager */
    protected $eventManager;

    /** @var \Fungio\GoogleMap\Events\Event */
    protected $eventMock;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventManager = new EventManager();
        $this->eventMock = $this->getMock('Fungio\GoogleMap\Events\Event');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->eventManager);
        unset($this->eventMock);
    }

    public function testDefaultState()
    {
        $this->assertEmpty($this->eventManager->getDomEvents());
        $this->assertEmpty($this->eventManager->getDomEventsOnce());
        $this->assertEmpty($this->eventManager->getEvents());
        $this->assertEmpty($this->eventManager->getEventsOnce());
    }

    public function testInitialState()
    {
        $domEvents = array($this->getMock('Fungio\GoogleMap\Events\Event'));
        $domEventsOnce = array($this->getMock('Fungio\GoogleMap\Events\Event'));
        $events = array($this->getMock('Fungio\GoogleMap\Events\Event'));
        $eventsOnce = array($this->getMock('Fungio\GoogleMap\Events\Event'));

        $this->eventManager = new EventManager($domEvents, $domEventsOnce, $events, $eventsOnce);

        $this->assertSame($domEvents, $this->eventManager->getDomEvents());
        $this->assertSame($domEventsOnce, $this->eventManager->getDomEventsOnce());
        $this->assertSame($events, $this->eventManager->getEvents());
        $this->assertSame($eventsOnce, $this->eventManager->getEventsOnce());
    }

    public function testDomEvent()
    {
        $this->eventManager->addDomEvent($this->eventMock);

        $this->assertSame(array($this->eventMock), $this->eventManager->getDomEvents());
    }

    public function testDomEventOnce()
    {
        $this->eventManager->addDomEventOnce($this->eventMock);

        $this->assertSame(array($this->eventMock), $this->eventManager->getDomEventsOnce());
    }

    public function testEvent()
    {
        $this->eventManager->addEvent($this->eventMock);

        $this->assertSame(array($this->eventMock), $this->eventManager->getEvents());
    }

    public function testEventOnce()
    {
        $this->eventManager->addEventOnce($this->eventMock);

        $this->assertSame(array($this->eventMock), $this->eventManager->getEventsOnce());
    }
}
