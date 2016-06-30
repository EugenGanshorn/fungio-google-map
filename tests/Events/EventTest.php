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

use Fungio\GoogleMap\Events\Event;

/**
 * Event test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Events\Event */
    protected $event;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->event = new Event();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->event);
    }

    public function testDefaultState()
    {
        $this->assertNull($this->event->getInstance());
        $this->assertNull($this->event->getEventName());
        $this->assertNull($this->event->getHandle());
        $this->assertFalse($this->event->isCapture());
    }

    public function testInitialState()
    {
        $this->event = new Event('foo', 'bar', 'baz', true);

        $this->assertSame('foo', $this->event->getInstance());
        $this->assertSame('bar', $this->event->getEventName());
        $this->assertSame('baz', $this->event->getHandle());
        $this->assertTrue($this->event->isCapture());
    }

    public function testInstanceWithValidValue()
    {
        $this->event->setInstance('foo');

        $this->assertSame('foo', $this->event->getInstance());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\EventException
     * @expectedExceptionMessage The instance of an event must be a string value.
     */
    public function testInstanceWithInvalidValue()
    {
        $this->event->setInstance(true);
    }

    public function testEventNameWithValidValue()
    {
        $this->event->setEventName('foo');

        $this->assertSame('foo', $this->event->getEventName());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\EventException
     * @expectedExceptionMessage The event name of an event must be a string value.
     */
    public function testEventNameWithInvalidValue()
    {
        $this->event->setEventName(true);
    }

    public function testHandleWithValidValue()
    {
        $this->event->setHandle('foo');

        $this->assertSame('foo', $this->event->getHandle());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\EventException
     * @expectedExceptionMessage The handle of an event must be a string value.
     */
    public function testHandleWithInvalidValue()
    {
        $this->event->setHandle(true);
    }

    public function testCaptureWithValidValue()
    {
        $this->event->setCapture(true);

        $this->assertTrue($this->event->isCapture());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\EventException
     * @expectedExceptionMessage The capture property of an event must be a boolean value.
     */
    public function testCaptureWithInvalidValue()
    {
        $this->event->setCapture('foo');
    }
}
