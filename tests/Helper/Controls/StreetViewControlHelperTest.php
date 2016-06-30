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
use Fungio\GoogleMap\Controls\StreetViewControl;
use Fungio\GoogleMap\Helper\Controls\StreetViewControlHelper;

/**
 * Street view control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Controls\StreetViewControlHelper */
    protected $streetViewControlHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->streetViewControlHelper = new StreetViewControlHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->streetViewControlHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Fungio\GoogleMap\Helper\Controls\ControlPositionHelper',
            $this->streetViewControlHelper->getControlPositionHelper()
        );
    }

    public function testInitialState()
    {
        $controlPositionHelper = $this->getMock('Fungio\GoogleMap\Helper\Controls\ControlPositionHelper');

        $this->streetViewControlHelper = new StreetViewControlHelper($controlPositionHelper);

        $this->assertSame($controlPositionHelper, $this->streetViewControlHelper->getControlPositionHelper());
    }

    public function testRender()
    {
        $streetViewControl = new StreetViewControl(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER}',
            $this->streetViewControlHelper->render($streetViewControl)
        );
    }
}
