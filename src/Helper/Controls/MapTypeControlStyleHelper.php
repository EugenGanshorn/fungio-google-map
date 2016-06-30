<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Helper\Controls;

use Fungio\GoogleMap\Controls\MapTypeControlStyle;
use Fungio\GoogleMap\Exception\HelperException;

/**
 * Map type control style helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyleHelper
{
    /**
     * Renders a map type control style.
     *
     * @param string $mapTypeControlStyle The map type control style.
     *
     * @throws \Fungio\GoogleMap\Exception\ControlException If the map type control style is not valid.
     *
     * @return string The JS output.
     */
    public function render($mapTypeControlStyle)
    {
        switch ($mapTypeControlStyle) {
            case MapTypeControlStyle::DEFAULT_:
            case MapTypeControlStyle::DROPDOWN_MENU:
            case MapTypeControlStyle::HORIZONTAL_BAR:
                return sprintf('google.maps.MapTypeControlStyle.%s', strtoupper($mapTypeControlStyle));
            default:
                throw HelperException::invalidMapTypeControlStyle();
        }
    }
}
