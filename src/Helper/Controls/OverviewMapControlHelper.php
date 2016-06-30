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

use Fungio\GoogleMap\Controls\OverviewMapControl;
use Fungio\GoogleMap\Helper\AbstractHelper;

/**
 * Overview map control helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlHelper extends AbstractHelper
{
    /**
     * Renders an overview map control.
     *
     * @param \Fungio\GoogleMap\Controls\OverviewMapControl $overviewMapControl The overview map control.
     *
     * @return string The JS output.
     */
    public function render(OverviewMapControl $overviewMapControl)
    {
        return $this->jsonBuilder
            ->reset()
            ->setValue('[opened]', $overviewMapControl->isOpened())
            ->build();
    }
}
