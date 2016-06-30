<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Controls;

use Fungio\GoogleMap\Controls\ControlPosition;
use Fungio\GoogleMap\Controls\StreetViewControl;

/**
 * Street view control test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Controls\StreetViewControl */
    protected $streetViewControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->streetViewControl = new StreetViewControl();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->streetViewControl);
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::TOP_LEFT, $this->streetViewControl->getControlPosition());
    }

    public function testInitialState()
    {
        $this->streetViewControl = new StreetViewControl(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->streetViewControl->getControlPosition());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\ControlException
     */
    public function testControlPositionWithInvalidValue()
    {
        $this->streetViewControl->setControlPosition('foo');
    }
}
