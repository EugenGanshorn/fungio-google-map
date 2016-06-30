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

use Fungio\GoogleMap\Controls\ControlPosition;
use Fungio\GoogleMap\Controls\ZoomControl;
use Fungio\GoogleMap\Controls\ZoomControlStyle;
use Fungio\GoogleMap\Helper\Controls\ZoomControlHelper;

/**
 * Zoom control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Controls\ZoomControlHelper */
    protected $zoomControlHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->zoomControlHelper = new ZoomControlHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->zoomControlHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Fungio\GoogleMap\Helper\Controls\ControlPositionHelper',
            $this->zoomControlHelper->getControlPositionHelper()
        );

        $this->assertInstanceOf(
            'Fungio\GoogleMap\Helper\Controls\ZoomControlStyleHelper',
            $this->zoomControlHelper->getZoomControlStyleHelper()
        );
    }

    public function testInitialState()
    {
        $controlPositionHelper = $this->getMock('Fungio\GoogleMap\Helper\Controls\ControlPositionHelper');
        $zoomControlStyleHelper = $this->getMock('Fungio\GoogleMap\Helper\Controls\ZoomControlStyleHelper');

        $this->zoomControlHelper = new ZoomControlHelper($controlPositionHelper, $zoomControlStyleHelper);

        $this->assertSame($controlPositionHelper, $this->zoomControlHelper->getControlPositionHelper());
        $this->assertSame($zoomControlStyleHelper, $this->zoomControlHelper->getZoomControlStyleHelper());
    }

    public function testRender()
    {
        $zoomControlTest = new ZoomControl(ControlPosition::BOTTOM_CENTER, ZoomControlStyle::SMALL);

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER,"style":google.maps.ZoomControlStyle.SMALL}',
            $this->zoomControlHelper->render($zoomControlTest)
        );
    }
}
