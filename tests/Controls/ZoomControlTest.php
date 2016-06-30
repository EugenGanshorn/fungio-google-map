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
use Fungio\GoogleMap\Controls\ZoomControl;
use Fungio\GoogleMap\Controls\ZoomControlStyle;

/**
 * Zoom control test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Controls\ZoomControl */
    protected $zoomControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->zoomControl = new ZoomControl();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->zoomControl);
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::TOP_LEFT, $this->zoomControl->getControlPosition());
        $this->assertSame(ZoomControlStyle::DEFAULT_, $this->zoomControl->getZoomControlStyle());
    }

    public function testInitialState()
    {
        $this->zoomControl = new ZoomControl(ControlPosition::BOTTOM_CENTER, ZoomControlStyle::LARGE);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->zoomControl->getControlPosition());
        $this->assertSame(ZoomControlStyle::LARGE, $this->zoomControl->getZoomControlStyle());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\ControlException
     */
    public function testControlPositionWithInvalidValue()
    {
        $this->zoomControl->setControlPosition('foo');
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The zoom control style of a zoom control can only be : default, large, small.
     */
    public function testZoomControlStyleWithInvalidValue()
    {
        $this->zoomControl->setZoomControlStyle('foo');
    }
}
