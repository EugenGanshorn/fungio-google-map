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
use Fungio\GoogleMap\Controls\MapTypeControl;
use Fungio\GoogleMap\Controls\MapTypeControlStyle;
use Fungio\GoogleMap\MapTypeId;
use Fungio\GoogleMap\Helper\Controls\MapTypeControlHelper;

/**
 * Map type control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Controls\MapTypeControlHelper */
    protected $mapTypeControlHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeControlHelper = new MapTypeControlHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapTypeControlHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Fungio\GoogleMap\Helper\MapTypeIdHelper',
            $this->mapTypeControlHelper->getMapTypeIdHelper()
        );

        $this->assertInstanceOf(
            'Fungio\GoogleMap\Helper\Controls\ControlPositionHelper',
            $this->mapTypeControlHelper->getControlPositionHelper()
        );

        $this->assertInstanceOf(
            'Fungio\GoogleMap\Helper\Controls\MapTypeControlStyleHelper',
            $this->mapTypeControlHelper->getMapTypeControlStyleHelper()
        );
    }

    public function testInitialState()
    {
        $mapTypeIdHelper = $this->getMock('Fungio\GoogleMap\Helper\MapTypeIdHelper');
        $controlPositionHelper = $this->getMock('Fungio\GoogleMap\Helper\Controls\ControlPositionHelper');
        $mapTypeControlStyleHelper = $this->getMock('Fungio\GoogleMap\Helper\Controls\MapTypeControlStyleHelper');

        $this->mapTypeControlHelper = new MapTypeControlHelper(
            $mapTypeIdHelper,
            $controlPositionHelper,
            $mapTypeControlStyleHelper
        );

        $this->assertSame($mapTypeIdHelper, $this->mapTypeControlHelper->getMapTypeIdHelper());
        $this->assertSame($controlPositionHelper, $this->mapTypeControlHelper->getControlPositionHelper());
        $this->assertSame($mapTypeControlStyleHelper, $this->mapTypeControlHelper->getMapTypeControlStyleHelper());
    }

    public function testRender()
    {
        $mapTypeControl = new MapTypeControl(
            array(MapTypeId::ROADMAP),
            ControlPosition::BOTTOM_CENTER,
            MapTypeControlStyle::DROPDOWN_MENU
        );

        $expected = '{'.
            '"mapTypeIds":[google.maps.MapTypeId.ROADMAP],'.
            '"position":google.maps.ControlPosition.BOTTOM_CENTER,'.
            '"style":google.maps.MapTypeControlStyle.DROPDOWN_MENU'.
            '}';

        $this->assertSame($expected, $this->mapTypeControlHelper->render($mapTypeControl));
    }
}
