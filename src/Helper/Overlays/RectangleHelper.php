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
use Fungio\GoogleMap\Overlays\Rectangle;

/**
 * Rectangle helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleHelper extends AbstractHelper
{
    /**
     * Renders a rectangle.
     *
     * @param \Fungio\GoogleMap\Overlays\Rectangle $rectangle The rectangle.
     * @param \Fungio\GoogleMap\Map                $map       The map.
     *
     * @return string The JS output.
     */
    public function render(Rectangle $rectangle, Map $map)
    {
        $this->jsonBuilder
            ->reset()
            ->setValue('[map]', $map->getJavascriptVariable(), false)
            ->setValue('[bounds]', $rectangle->getBound()->getJavascriptVariable(), false)
            ->setValues($rectangle->getOptions());

        return sprintf(
            '%s = new google.maps.Rectangle(%s);'.PHP_EOL,
            $rectangle->getJavascriptVariable(),
            $this->jsonBuilder->build()
        );
    }
}
