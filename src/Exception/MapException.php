<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Exception;

/**
 * Fungio google map exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapException extends Exception
{
    /**
     * Gets the "INVALID ASYNC" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INVALID ASYNC" exception.
     */
    public static function invalidAsync()
    {
        return new static('The asynchronous load of a map must be a boolean value.');
    }

    /**
     * Gets the "INVALID AUTO ZOOM" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INVALID AUTO ZOOM" exception.
     */
    public static function invalidAutoZoom()
    {
        return new static('The auto zoom of a map must be a boolean value.');
    }

    /**
     * Gets the "INVALID BOUND" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INVALID BOUND" exception.
     */
    public static function invalidBound()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The bound setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setBound(Fungio\GoogleMap\Base\Bound $bound)',
            ' - function setBount('.
            'Fungio\GoogleMap\Base\Coordinate $southWest, '.
            'Fungio\GoogleMap\Base\Coordinate $northEast'.
            ')',
            ' - function setBound('.
            'double $southWestLatitude, '.
            'double $southWestLongitude, '.
            'double $northEastLatitude, '.
            'double $northEastLongitude, '.
            'boolean southWestNoWrap = true, '.
            'boolean $northEastNoWrap = true'.
            ')'
        ));
    }

    /**
     * Gets the "INVALID CENTER" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INVALID CENTER" exception.
     */
    public static function invalidCenter()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The center setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setCenter(Fungio\GoogleMap\Base\Coordinate $center)',
            ' - function setCenter(double $latitude, double $longitude, boolean $noWrap = true)'
        ));
    }

    /**
     * Gets the "INVALID HTML CONTAINER ID" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INVALID HTML CONTAINER ID" exception.
     */
    public static function invalidHtmlContainerId()
    {
        return new static('The html container id of a map must be a string value.');
    }

    /**
     * Gets the "INVALID MAP OPTION" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INVALID MAP OPTION" exception.
     */
    public static function invalidMapOption()
    {
        return new static('The map option property of a map must be a string value.');
    }

    /**
     * Gets the "INVALID MAP TYPE CONTROL" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INAVLID MAP TYPE CONTROL" exception.
     */
    public static function invalidMapTypeControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The map type control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setMapTypeControl(Fungio\GoogleMap\Controls\MapTypeControl $mapTypeControl = null)',
            ' - function setMaptypeControl(array $mapTypeIds, string $controlPosition, string $mapTypeControlStyle)'
        ));
    }

    /**
     * Gets the "INVALID OVERVIEW MAP CONTROL" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INVALID OVERVIEW MAP CONTROL" exception.
     */
    public static function invalidOverviewMapControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The overview map control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setOverviewMapControl(Fungio\GoogleMap\Controls\OverviewMapControl $overviewMapControl = null)',
            ' - function setOverviewMapControl(boolean $opened)'
        ));
    }

    /**
     * Gets the "INVALID PAN CONTROL" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INVALID PAN CONTROL" exception.
     */
    public static function invalidPanControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The pan control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setPanControl(Fungio\GoogleMap\Controls\PanControl $panControl = null)',
            ' - function setPanControl(string $controlPosition)'
        ));
    }

    /**
     * Gets the "INVALID ROTATE CONTROL" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INVALID ROTATE CONTROL" exception.
     */
    public static function invalidRotateControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The rotate control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setRotateControl(Fungio\GoogleMap\Controls\RotateControl $rotateControl = null)',
            ' - function setRotateControl(string $controlPosition)'
        ));
    }

    /**
     * Gets the "INVALID SCALE CONTROL" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INVALID SCALE CONTROL" exception.
     */
    public static function invalidScaleControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The scale control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setScaleControl(Fungio\GoogleMap\Controls\ScaleControl $scaleControl = null)',
            ' - function setScaleControl(string $controlPosition, string $scaleControlStyle)'
        ));
    }

    /**
     * Gets the "INVALID STREET VIEW CONTROL" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INVALID STREET VIEW CONTROL" exception.
     */
    public static function invalidStreetViewControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The street view control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setStreetViewControl(Fungio\GoogleMap\Controls\StreetViewControl $streetViewControl = null)',
            ' - function setStreetViewControl(string $controlPosition)'
        ));
    }

    /**
     * Gets the "INVALID ZOOM CONTROL" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INVALID ZOOM CONTROL" exception.
     */
    public static function invalidZoomControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The zoom control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setZoomControl(Fungio\GoogleMap\Controls\ZoomControl $zoomControl = null)',
            ' - function setZoomControl(string $controlPosition, string $zoomControlStyle)'
        ));
    }

    /**
     * Gets the "INVALID STYLESHEET OPTION" exception.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "INAVLID STYLESHEET OPTION" exception.
     */
    public static function invalidStylesheetOption()
    {
        return new static('The stylesheet option property of a map must be a string value.');
    }

    /**
     * Gets the "MAP OPTION DOES NOT EXIST" exception.
     *
     * @param string $mapOption The map option.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "MAP OPTION DOES NOT EXIST" exception.
     */
    public static function mapOptionDoesNotExist($mapOption)
    {
        return new static(sprintf('The map option "%s" does not exist.', $mapOption));
    }

    /**
     * Gets the "STYLESHEET OPTION DOES NOT EXIST" exception.
     *
     * @param string $stylesheetOption The stylesheet option.
     *
     * @return \Fungio\GoogleMap\Exception\MapException The "STYLESHEET OPTION DOES NOT EXIST" exception.
     */
    public static function stylesheetOptionDoesNotExist($stylesheetOption)
    {
        return new static(sprintf('The stylesheet option "%s" does not exist.', $stylesheetOption));
    }
}
