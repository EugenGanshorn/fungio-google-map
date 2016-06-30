<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Helper\Layers;

use Fungio\GoogleMap\Helper\AbstractHelper;
use Fungio\GoogleMap\Layers\KMLLayer;
use Fungio\GoogleMap\Map;

/**
 * KML Layer helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KMLLayerHelper extends AbstractHelper
{
    /**
     * Renders a kml layer.
     *
     * @param \Fungio\GoogleMap\Layers\KMLLayer $kmlLayer The KML layer.
     * @param \Fungio\GoogleMap\Map             $map      The map.
     *
     * @return string The JS output.
     */
    public function render(KMLLayer $kmlLayer, Map $map)
    {
        $this->jsonBuilder
            ->reset()
            ->setValue('[map]', $map->getJavascriptVariable(), false)
            ->setValues($kmlLayer->getOptions());

        return sprintf(
            '%s = new google.maps.KmlLayer("%s", %s);'.PHP_EOL,
            $kmlLayer->getJavascriptVariable(),
            $kmlLayer->getUrl(),
            $this->jsonBuilder->build()
        );
    }
}
