<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Services\DistanceMatrix;

use Fungio\GoogleMap\Services\DistanceMatrix\DistanceMatrixElementStatus;
use Fungio\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponseElement;

/**
 * Directions response row test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsResponseElementTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse */
    protected $distanceMatrixResponseElement;

    /** @var string */
    protected $status;

    /** @var \Fungio\GoogleMap\Services\Base\Distance */
    protected $distance;

    /** @var \Fungio\GoogleMap\Services\Base\Duration */
    protected $duration;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->status = DistanceMatrixElementStatus::ZERO_RESULTS;

        $this->distance = $this->getMockBuilder('Fungio\GoogleMap\Services\Base\Distance')
            ->disableOriginalConstructor()
            ->getMock();

        $this->duration = $this->getMockBuilder('Fungio\GoogleMap\Services\Base\Duration')
            ->disableOriginalConstructor()
            ->getMock();

        $this->distanceMatrixResponseElement = new DistanceMatrixResponseElement(
            $this->status,
            $this->distance,
            $this->duration
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->status);
        unset($this->distance);
        unset($this->duration);
        unset($this->distanceMatrixResponseElement);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->status, $this->distanceMatrixResponseElement->getStatus());
        $this->assertSame($this->distance, $this->distanceMatrixResponseElement->getDistance());
        $this->assertSame($this->duration, $this->distanceMatrixResponseElement->getDuration());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\DistanceMatrixException
     * @expectedExceptionMessage The distance matrix response element status can only be : NOT_FOUND, OK, ZERO_RESULTS.
     */
    public function testStatusWithInvalidValue()
    {
        $this->distanceMatrixResponseElement->setStatus('foo');
    }
}
