<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Services\DistanceMatrix;

use Fungio\GoogleMap\Exception\DistanceMatrixException;
use Fungio\GoogleMap\Services\Base\Distance;
use Fungio\GoogleMap\Services\Base\Duration;
use Fungio\GoogleMap\Services\DistanceMatrix\DistanceMatrixElementStatus;

/**
 * A distance matrix response wraps the distance results & the response status.
 *
 * @author GeLo <geloen.eric@gmail.com>
 * @author Tyler Sommer <sommertm@gmail.com>
 */
class DistanceMatrixResponseElement
{
    /** @var string */
    protected $status;

    /** @var null|\Fungio\GoogleMap\Services\Base\Distance */
    protected $distance;

    /** @var null|\Fungio\GoogleMap\Services\Base\Duration */
    protected $duration;

    /**
     * Create a distance matrix response element.
     *
     * @param \Fungio\GoogleMap\Services\Base\Distance $distance The element distance.
     * @param \Fungio\GoogleMap\Services\Base\Duration $duration The element duration.
     * @param string                                  $status   The element status.
     */
    public function __construct($status, Distance $distance = null, Duration $duration = null)
    {
        $this->setStatus($status);

        if ($distance !== null) {
            $this->setDistance($distance);
        }

        if ($duration !== null) {
            $this->setDuration($duration);
        }
    }

    /**
     * Gets the distance matrix response status.
     *
     * @return string The distance matrix response status.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the distance matrix response status.
     *
     * @param string $status The distance matrix status.
     *
     * @throws \Fungio\GoogleMap\Exception\DistanceMatrixException If the status is not valid.
     */
    public function setStatus($status)
    {
        if (!in_array($status, DistanceMatrixElementStatus::getDistanceMatrixElementStatus())) {
            throw DistanceMatrixException::invalidDistanceMatrixResponseElementStatus();
        }

        $this->status = $status;
    }

    /**
     * Gets the step distance.
     *
     * @return \Fungio\GoogleMap\Services\Base\Distance The step distance.
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Sets the step distance.
     *
     * @param \Fungio\GoogleMap\Services\Base\Distance $distance The step distance.
     */
    public function setDistance(Distance $distance)
    {
        $this->distance = $distance;
    }

    /**
     * Gets the step duration.
     *
     * @return \Fungio\GoogleMap\Services\Base\Duration The step duration.
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Sets the step duration
     *
     * @param \Fungio\GoogleMap\Services\Base\Duration $duration The step duration.
     */
    public function setDuration(Duration $duration)
    {
        $this->duration = $duration;
    }
}
