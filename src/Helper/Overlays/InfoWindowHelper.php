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
use Fungio\GoogleMap\Overlays\Marker;
use Fungio\GoogleMap\Overlays\InfoWindow;

/**
 * Info window helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowHelper extends AbstractHelper
{
   /**
     * Renders an info window.
     *
     * @param \Fungio\GoogleMap\Overlays\InfoWindow $infoWindow     The info window.
     * @param boolean                              $renderPosition TRUE if the position is rendered else FALSE.
     *
     * @return string The JS output.
     */
    public function render(InfoWindow $infoWindow, $renderPosition = true)
    {
        $this->doRender($infoWindow, $renderPosition);

        return sprintf(
            '%s = new google.maps.InfoWindow(%s);'.PHP_EOL,
            $infoWindow->getJavascriptVariable(),
            $this->jsonBuilder->build()
        );
    }

    /**
     * Renders the info window open flag.
     *
     * @param \Fungio\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     * @param \Fungio\GoogleMap\Map                 $map        The map.
     * @param \Fungio\GoogleMap\Overlays\Marker     $marker     The marker.
     *
     * @return string The JS output.
     */
    public function renderOpen(InfoWindow $infoWindow, Map $map, Marker $marker = null)
    {
        if ($marker !== null) {
            return sprintf(
                '%s.open(%s, %s);'.PHP_EOL,
                $infoWindow->getJavascriptVariable(),
                $map->getJavascriptVariable(),
                $marker->getJavascriptVariable()
            );
        }

        return sprintf('%s.open(%s);'.PHP_EOL, $infoWindow->getJavascriptVariable(), $map->getJavascriptVariable());
    }

    /**
     * Configures the json builder in order to render an info window.
     *
     * @param \Fungio\GoogleMap\Helper\Overlays\InfoWinfow $infoWindow     The info window.
     * @param boolean                                     $renderPosition TRUE if the position is rendered else FALSE.
     */
    protected function doRender(InfoWindow $infoWindow, $renderPosition)
    {
        $this->jsonBuilder->reset();

        if ($renderPosition) {
            $this->jsonBuilder->setValue('[position]', $infoWindow->getPosition()->getJavascriptVariable(), false);
        }

        if ($infoWindow->hasPixelOffset()) {
            $this->jsonBuilder->setValue(
                '[pixelOffset]',
                $infoWindow->getPixelOffset()->getJavascriptVariable(),
                false
            );
        }

        $this->jsonBuilder
            ->setValue('[content]', $infoWindow->getContent())
            ->setValues($infoWindow->getOptions());
    }
}
