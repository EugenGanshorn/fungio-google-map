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
use Fungio\GoogleMap\Controls\PanControl;

/**
 * Pan control test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Controls\PanControl */
    protected $panControl;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->panControl = new PanControl();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->panControl);
    }

    public function testDefaultState()
    {
        $this->assertSame(ControlPosition::TOP_LEFT, $this->panControl->getControlPosition());
    }

    public function testInitialState()
    {
        $this->panControl = new PanControl(ControlPosition::LEFT_CENTER);

        $this->assertSame(ControlPosition::LEFT_CENTER, $this->panControl->getControlPosition());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\ControlException
     */
    public function testControlPositionWithInvalidValue()
    {
        $this->panControl->setControlPosition('foo');
    }
}
