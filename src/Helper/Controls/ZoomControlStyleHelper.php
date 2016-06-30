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

use Fungio\GoogleMap\Controls\ZoomControlStyle;
use Fungio\GoogleMap\Exception\HelperException;

/**
 * Zoom control style helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlStyleHelper
{
    /**
     * Renders a zoom control style.
     *
     * @param string $zoomControlStyle The zoom control style.
     *
     * @throws \Fungio\GoogleMap\Exception\HelperException If thhe zoom control style is not valid.
     *
     * @return string The JS output.
     */
    public function render($zoomControlStyle)
    {
        switch ($zoomControlStyle) {
            case ZoomControlStyle::DEFAULT_:
            case ZoomControlStyle::LARGE:
            case ZoomControlStyle::SMALL:
                return sprintf('google.maps.ZoomControlStyle.%s', strtoupper($zoomControlStyle));
            default:
                throw HelperException::invalidZoomControlStyle();
        }
    }
}
