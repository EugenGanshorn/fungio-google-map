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

use Fungio\GoogleMap\Services\Directions\DirectionsStep;
use Fungio\GoogleMap\Services\Base\TravelMode;

/**
 * Directions step test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsStepTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Services\Directions\DirectionsStep */
    protected $directionsStep;

    /** @var \Fungio\GoogleMap\Services\Base\Distance */
    protected $distance;

    /** @var \Fungio\GoogleMap\Services\Base\Duration */
    protected $duration;

    /** @var \Fungio\GoogleMap\Base\Coordinate */
    protected $endLocation;

    /** @var string */
    protected $instructions;

    /** @var \Fungio\GoogleMap\Overlays\EncodedPolyline */
    protected $encodedPolyline;

    /** @var \Fungio\GoogleMap\Base\Coordinate */
    protected $startLocation;

    /** @var string */
    protected $travelMode;

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

        $this->endLocation = $this->getMock('Fungio\GoogleMap\Base\Coordinate');
        $this->instructions = 'instructions';
        $this->encodedPolyline = $this->getMock('Fungio\GoogleMap\Overlays\EncodedPolyline');
        $this->startLocation = $this->getMock('Fungio\GoogleMap\Base\Coordinate');
        $this->travelMode = TravelMode::DRIVING;

        $this->directionsStep = new DirectionsStep(
            $this->distance,
            $this->duration,
            $this->endLocation,
            $this->instructions,
            $this->encodedPolyline,
            $this->startLocation,
            $this->travelMode
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directionsStep);
        unset($this->distance);
        unset($this->duration);
        unset($this->endLocation);
        unset($this->instructions);
        unset($this->encodedPolyline);
        unset($this->startLocation);
        unset($this->travelMode);
    }

    public function testInitialState()
    {
        $this->assertSame($this->distance, $this->directionsStep->getDistance());
        $this->assertSame($this->duration, $this->directionsStep->getDuration());
        $this->assertSame($this->endLocation, $this->directionsStep->getEndLocation());
        $this->assertSame($this->instructions, $this->directionsStep->getInstructions());
        $this->assertSame($this->encodedPolyline, $this->directionsStep->getEncodedPolyline());
        $this->assertSame($this->startLocation, $this->directionsStep->getStartLocation());
        $this->assertSame($this->travelMode, $this->directionsStep->getTravelMode());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The step instructions must be a string value.
     */
    public function testInstructionsWithInvalidValue()
    {
        $this->directionsStep->setInstructions(true);
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions step travel mode can only be : BICYCLING, DRIVING, WALKING, TRANSIT.
     */
    public function testTravelModeWithInvalidValue()
    {
        $this->directionsStep->setTravelMode('foo');
    }
}
