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
use Fungio\GoogleMap\Overlays\Circle;

/**
 * Circle helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleHelper extends AbstractHelper
{
   /**
     * Renders a circle.
     *
     * @param \Fungio\GoogleMap\Overlays\Circle $circle The circle.
     * @param \Fungio\GoogleMap\Map             $map    The map.
     *
     * @return string The JS output.
     */
    public function render(Circle $circle, Map $map)
    {
        $this->jsonBuilder
            ->reset()
            ->setValue('[map]', $map->getJavascriptVariable(), false)
            ->setValue('[center]', $circle->getCenter()->getJavascriptVariable(), false)
            ->setValue('[radius]', $circle->getRadius())
            ->setValues($circle->getOptions());

        return sprintf(
            '%s = new google.maps.Circle(%s);'.PHP_EOL,
            $circle->getJavascriptVariable(),
            $this->jsonBuilder->build()
        );
    }
}
