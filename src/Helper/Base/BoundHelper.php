<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Helper\Base;

use Fungio\GoogleMap\Base\Bound;
use Fungio\GoogleMap\Overlays\Circle;
use Fungio\GoogleMap\Overlays\EncodedPolyline;
use Fungio\GoogleMap\Overlays\GroundOverlay;
use Fungio\GoogleMap\Overlays\InfoWindow;
use Fungio\GoogleMap\Overlays\Marker;
use Fungio\GoogleMap\Overlays\Polyline;
use Fungio\GoogleMap\Overlays\Polygon;
use Fungio\GoogleMap\Overlays\Rectangle;

/**
 * Bound helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundHelper
{
    /**
     * Renders the bound.
     *
     * @param \Fungio\GoogleMap\Base\Bound $bound The bound.
     *
     * @return string The JS output.
     */
    public function render(Bound $bound)
    {
        if ($bound->hasExtends() || !$bound->hasCoordinates()) {
            return sprintf('%s = new google.maps.LatLngBounds();'.PHP_EOL, $bound->getJavascriptVariable());
        }

        return sprintf(
            '%s = new google.maps.LatLngBounds(%s, %s);'.PHP_EOL,
            $bound->getJavascriptVariable(),
            $bound->getSouthWest()->getJavascriptVariable(),
            $bound->getNorthEast()->getJavascriptVariable()
        );
    }

    /**
     * Renders the bound's extend of a marker.
     *
     * @param \Fungio\GoogleMap\Base\Bound $bound The bound.
     *
     * @return string The JS output.
     */
    public function renderExtends(Bound $bound)
    {
        $output = array();

        foreach ($bound->getExtends() as $extend) {
            if (($extend instanceof Marker) || ($extend instanceof InfoWindow)) {
                $output[] = sprintf(
                    '%s.extend(%s.getPosition());'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getJavascriptVariable()
                );
            } elseif (($extend instanceof Polyline)
                || ($extend instanceof EncodedPolyline)
                || ($extend instanceof Polygon)
            ) {
                $output[] = sprintf(
                    '%s.getPath().forEach(function(element){%s.extend(element)});'.PHP_EOL,
                    $extend->getJavascriptVariable(),
                    $bound->getJavascriptVariable()
                );
            } elseif (($extend instanceof Rectangle) || ($extend instanceof GroundOverlay)) {
                $output[] = sprintf(
                    '%s.union(%s);'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getBound()->getJavascriptVariable()
                );
            } elseif ($extend instanceof Circle) {
                $output[] = sprintf(
                    '%s.union(%s.getBounds());'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getJavascriptVariable()
                );
            }
        }

        return implode('', $output);
    }
}
