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
use Fungio\GoogleMap\Controls\ScaleControl;
use Fungio\GoogleMap\Controls\ScaleControlStyle;

/**
 * Scale control test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Controls\ScaleControl */
    protected $scaleControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->scaleControl = new ScaleControl();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->scaleControl);
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::BOTTOM_LEFT, $this->scaleControl->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $this->scaleControl->getScaleControlStyle());
    }

    public function testInitialState()
    {
        $this->scaleControl = new ScaleControl(ControlPosition::BOTTOM_CENTER, ScaleControlStyle::DEFAULT_);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->scaleControl->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $this->scaleControl->getScaleControlStyle());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\ControlException
     */
    public function testControlPositionWithInvalidValue()
    {
        $this->scaleControl->setControlPosition('foo');
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The scale control style of a scale control can only be : default.
     */
    public function testScaleControlStyleWithInvalidValue()
    {
        $this->scaleControl->setScaleControlStyle('foo');
    }
}
