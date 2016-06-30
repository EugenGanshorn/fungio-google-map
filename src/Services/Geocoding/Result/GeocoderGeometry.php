<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Services\Geocoding\Result;

use Fungio\GoogleMap\Base\Bound;
use Fungio\GoogleMap\Base\Coordinate;
use Fungio\GoogleMap\Exception\GeocodingException;

/**
 * GeocoderGeometry which describes a google map geocoder geometry.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderGeometry
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderGeometry
{
    /** @var \Fungio\GoogleMap\Base\Coordinate */
    protected $location;

    /** @var string */
    protected $locationType;

    /** @var \Fungio\GoogleMap\Base\Bound */
    protected $viewport;

    /** @var \Fungio\GoogleMap\Base\Bound */
    protected $bound;

    /**
     * Create a geocoder geometry.
     *
     * @param \Fungio\GoogleMap\Base\Coordinate $location     The geometry location.
     * @param string                           $locationType The geometry location type.
     * @param \Fungio\GoogleMap\Base\Bound      $viewport     The geometry viewport.
     * @param \Fungio\GoogleMap\Base\Bound      $bound        The geometry bound.
     */
    public function __construct(Coordinate $location, $locationType, Bound $viewport, Bound $bound = null)
    {
        $this->setLocation($location);
        $this->setLocationType($locationType);
        $this->setViewport($viewport);
        $this->setBound($bound);
    }

    /**
     * Gets the geometry location.
     *
     * @return \Fungio\GoogleMap\Base\Coordinate The geometry location.
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the geometry location.
     *
     * @param \Fungio\GoogleMap\Base\Coordinate $location The geometry location.
     */
    public function setLocation(Coordinate $location)
    {
        $this->location = $location;
    }

    /**
     * Gets the geometry location type.
     *
     * @return string The geometry location type.
     */
    public function getLocationType()
    {
        return $this->locationType;
    }

    /**
     * Sets the geometry location type.
     *
     * @param string $locationType The geometry location type.
     *
     * @throws \Fungio\GoogleMap\Exception\GeocodingException If the location type is not valid.
     */
    public function setLocationType($locationType)
    {
        if (!in_array($locationType, GeocoderLocationType::getGeocoderLocationTypes())) {
            throw GeocodingException::invalidGeocoderLocationType();
        }

        $this->locationType = $locationType;
    }

    /**
     * Gets the geometry viewport
     *
     * @return \Fungio\GoogleMap\Base\Bound The geometry viewport.
     */
    public function getViewport()
    {
        return $this->viewport;
    }

    /**
     * Sets the geometry viewport.
     *
     * @param \Fungio\GoogleMap\Base\Bound $viewport The geometry viewport.
     */
    public function setViewport(Bound $viewport)
    {
        $this->viewport = $viewport;
    }

    /**
     * Gets the geometry bound.
     *
     * @return \Fungio\GoogleMap\Base\Bound The geometry bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the geometry bound.
     *
     * @param \Fungio\GoogleMap\Base\Bound $bound The geometry bound.
     */
    public function setBound(Bound $bound = null)
    {
        $this->bound = $bound;
    }
}
