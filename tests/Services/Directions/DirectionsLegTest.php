<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Services\Directions;

use Fungio\GoogleMap\Services\Directions\DirectionsLeg;

/**
 * Directions leg test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsLegTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Services\Directions\DirectionsLeg */
    protected $directionsLeg;

    /** @var \Fungio\GoogleMap\Services\Base\Distance */
    protected $distance;

    /** @var \Fungio\GoogleMap\Services\Base\Duration */
    protected $duration;

    /** @var string */
    protected $endAddress;

    /** @var \Fungio\GoogleMap\Base\Coordinate */
    protected $endLocation;

    /** @var string */
    protected $startAddress;

    /** @var \Fungio\GoogleMap\Base\Coordinate */
    protected $startLocation;

    /** @var array */
    protected $steps;

    /** @var array */
    protected $viaWaypoint;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->distance = $this->getMockBuilder('Fungio\GoogleMap\Services\Base\Distance')
            ->disableOriginalConstructor()
            ->getMock();

        $this->duration = $this->getMockBuilder('Fungio\GoogleMap\Services\Base\Duration')
            ->disableOriginalConstructor()
            ->getMock();

        $this->endAddress = 'foo';
        $this->endLocation = $this->getMock('Fungio\GoogleMap\Base\Coordinate');
        $this->startAddress = 'bar';
        $this->startLocation = $this->getMock('Fungio\GoogleMap\Base\Coordinate');

        $step = $this->getMockBuilder('Fungio\GoogleMap\Services\Directions\DirectionsStep')
            ->disableOriginalConstructor()
            ->getMock();

        $this->steps = array($step);
        $this->viaWaypoint = array('foo');

        $this->directionsLeg = new DirectionsLeg(
            $this->distance,
            $this->duration,
            $this->endAddress,
            $this->endLocation,
            $this->startAddress,
            $this->startLocation,
            $this->steps,
            $this->viaWaypoint
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directionsLeg);
        unset($this->duration);
        unset($this->distance);
        unset($this->endAddress);
        unset($this->endLocation);
        unset($this->startAddress);
        unset($this->startLocation);
        unset($this->steps);
        unset($this->viaWaypoint);
    }

    public function testInitialState()
    {
        $this->assertSame($this->duration, $this->directionsLeg->getDuration());
        $this->assertSame($this->distance, $this->directionsLeg->getDistance());
        $this->assertSame($this->endAddress, $this->directionsLeg->getEndAddress());
        $this->assertSame($this->endLocation, $this->directionsLeg->getEndLocation());
        $this->assertSame($this->startAddress, $this->directionsLeg->getStartAddress());
        $this->assertSame($this->startLocation, $this->directionsLeg->getStartLocation());
        $this->assertSame($this->steps, $this->directionsLeg->getSteps());
        $this->assertSame($this->viaWaypoint, $this->directionsLeg->getViaWaypoints());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The leg end address must be a string value.
     */
    public function testEndAddressWithInvalidValue()
    {
        $this->directionsLeg->setEndAddress(true);
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The leg start address must be a string value.
     */
    public function testStartAddressWithInvalidValue()
    {
        $this->directionsLeg->setStartAddress(true);
    }
}
