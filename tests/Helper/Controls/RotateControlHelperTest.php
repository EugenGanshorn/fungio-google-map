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
use Fungio\GoogleMap\Controls\RotateControl;
use Fungio\GoogleMap\Helper\Controls\RotateControlHelper;

/**
 * Rotate control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Controls\RotateControlHelper */
    protected $rotateControlHelper;

    /**p
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rotateControlHelper = new RotateControlHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->rotateControlHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Fungio\GoogleMap\Helper\Controls\ControlPositionHelper',
            $this->rotateControlHelper->getControlPositionHelper()
        );
    }

    public function testInitialState()
    {
        $controlPositionHelper = $this->getMock('Fungio\GoogleMap\Helper\Controls\ControlPositionHelper');

        $this->rotateControlHelper = new RotateControlHelper($controlPositionHelper);

        $this->assertSame($controlPositionHelper, $this->rotateControlHelper->getControlPositionHelper());
    }

    public function testRender()
    {
        $rotateControl = new RotateControl(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(
            '{"position":google.maps.ControlPosition.BOTTOM_CENTER}',
            $this->rotateControlHelper->render($rotateControl)
        );
    }
}
