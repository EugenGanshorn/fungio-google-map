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
use Fungio\GoogleMap\Overlays\GroundOverlay;

/**
 * Ground overlay helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayHelper extends AbstractHelper
{
    /**
     * Renders a ground overlay.
     *
     * @param \Fungio\GoogleMap\Overlays\GroundOverlay $groundOverlay The ground overlay.
     * @param \Fungio\GoogleMap\Map                    $map           The map.
     *
     * @return string The JS output.
     */
    public function render(GroundOverlay $groundOverlay, Map $map)
    {
        $this->jsonBuilder
            ->reset()
            ->setValue('[map]', $map->getJavascriptVariable(), false)
            ->setValues($groundOverlay->getOptions());

        return sprintf(
            '%s = new google.maps.GroundOverlay("%s", %s, %s);'.PHP_EOL,
            $groundOverlay->getJavascriptVariable(),
            $groundOverlay->getUrl(),
            $groundOverlay->getBound()->getJavascriptVariable(),
            $this->jsonBuilder->build()
        );
    }
}
