<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Helper;

use Fungio\GoogleMap\Exception\HelperException;
use Fungio\GoogleMap\MapTypeId;

/**
 * Map type ID helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeIdHelper
{
    /**
     * Renders a map map type ID.
     *
     * @param string $mapTypeId The map type ID.
     *
     * @throws \Fungio\GoogleMap\Exception\HelperException If the map type ID is not valid.
     *
     * @return string The JS output.
     */
    public function render($mapTypeId)
    {
        switch ($mapTypeId) {
            case MapTypeId::HYBRID:
            case MapTypeId::ROADMAP:
            case MapTypeId::SATELLITE:
            case MapTypeId::TERRAIN:
                return sprintf('google.maps.MapTypeId.%s', strtoupper($mapTypeId));
            default:
                throw HelperException::invalidMapTypeId();
        }
    }
}
