<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Helper\Controls;

use Fungio\GoogleMap\Events\Event;
use Fungio\GoogleMap\Helper\Events\EventManagerHelper;

/**
 * Event manager helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Events\EventHelper */
    protected $eventManagerHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventManagerHelper = new EventManagerHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->eventManagerHelper);
    }

    public function testRenderDomEvent()
    {
        $domEvent = new Event('instance', 'event_name', 'handle', true);
        $domEvent->setJavascriptVariable('foo');

        $this->assertSame(
            'foo = google.maps.event.addDomListener(instance, "event_name", handle, true);'.PHP_EOL,
            $this->eventManagerHelper->renderDomEvent($domEvent)
        );
    }

    public function testRenderDomEventOnce()
    {
        $domEventOnce = new Event('instance', 'event_name', 'handle', true);
        $domEventOnce->setJavascriptVariable('foo');

        $this->assertSame(
            'foo = google.maps.event.addDomListenerOnce(instance, "event_name", handle, true);'.PHP_EOL,
            $this->eventManagerHelper->renderDomEventOnce($domEventOnce)
        );
    }

    public function testRenderEvent()
    {
        $event = new Event('instance', 'event_name', 'handle', true);
        $event->setJavascriptVariable('foo');

        $this->assertSame(
            'foo = google.maps.event.addListener(instance, "event_name", handle);'.PHP_EOL,
            $this->eventManagerHelper->renderEvent($event)
        );
    }

    public function testRenderEventOnce()
    {
        $eventOnce = new Event('instance', 'event_name', 'handle');
        $eventOnce->setJavascriptVariable('foo');

        $this->assertSame(
            'foo = google.maps.event.addListenerOnce(instance, "event_name", handle);'.PHP_EOL,
            $this->eventManagerHelper->renderEventOnce($eventOnce)
        );
    }
}
