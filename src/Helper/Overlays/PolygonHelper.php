<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Helper\Overlays;

use Fungio\GoogleMap\Helper\AbstractHelper;
use Fungio\GoogleMap\Map;
use Fungio\GoogleMap\Overlays\Polygon;

/**
 * Polygon helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonHelper extends AbstractHelper
{
    /**
     * Renders a polygon.
     *
     * @param \Fungio\GoogleMap\Overlays\Polygon $polygon The polygon.
     * @param \Fungio\GoogleMapl\Map             $map     The map.
     *
     * @return string Ths JS output.
     */
    public function render(Polygon $polygon, Map $map)
    {
        $this->jsonBuilder
            ->reset()
            ->setValue('[map]', $map->getJavascriptVariable(), false)
            ->setValue('[paths]', array());

        foreach ($polygon->getCoordinates() as $index => $coordinate) {
            $this->jsonBuilder->setValue(sprintf('[paths][%d]', $index), $coordinate->getJavascriptVariable(), false);
        }

        $this->jsonBuilder->setValues($polygon->getOptions());

        return sprintf(
            '%s = new google.maps.Polygon(%s);'.PHP_EOL,
            $polygon->getJavascriptVariable(),
            $this->jsonBuilder->build()
        );
    }
}
