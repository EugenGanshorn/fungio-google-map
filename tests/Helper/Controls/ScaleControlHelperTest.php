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
use Fungio\GoogleMap\Controls\ScaleControl;
use Fungio\GoogleMap\Controls\ScaleControlStyle;
use Fungio\GoogleMap\Helper\Controls\ScaleControlHelper;

/**
 * Scale control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Controls\ScaleControlHelper */
    protected $scaleControlHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->scaleControlHelper = new ScaleControlHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->scaleControlHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Fungio\GoogleMap\Helper\Controls\ControlPositionHelper',
            $this->scaleControlHelper->getControlPositionHelper()
        );

        $this->assertInstanceOf(
            'Fungio\GoogleMap\Helper\Controls\ScaleControlStyleHelper',
            $this->scaleControlHelper->getScaleControlStyleHelper()
        );
    }

    public function testInitialState()
    {
        $controlPositionHelper = $this->getMock('Fungio\GoogleMap\Helper\Controls\ControlPositionHelper');
        $scaleControlStyleHelper = $this->getMock('Fungio\GoogleMap\Helper\Controls\ScaleControlStyleHelper');

        $this->scaleControlHelper = new ScaleControlHelper($controlPositionHelper, $scaleControlStyleHelper);

        $this->assertSame($controlPositionHelper, $this->scaleControlHelper->getControlPositionHelper());
        $this->assertSame($scaleControlStyleHelper, $this->scaleControlHelper->getScaleControlStyleHelper());
    }

    public function testRender()
    {
        $scaleControl = new ScaleControl(ControlPosition::BOTTOM_CENTER, ScaleControlStyle::DEFAULT_);

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER,"style":google.maps.ScaleControlStyle.DEFAULT}',
            $this->scaleControlHelper->render($scaleControl)
        );
    }
}
