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

use Fungio\GoogleMap\Controls\StreetViewControl;
use Fungio\GoogleMap\Helper\AbstractHelper;

/**
 * Street view control helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlHelper extends AbstractHelper
{
    /** @var \Fungio\GoogleMap\Helper\Controls\ControlPositionHelper */
    protected $controlPositionHelper;

    /**
     * Creates a street view control helper.
     *
     * @param \Fungio\GoogleMap\Helper\Controls\ControlPositionHelper $controlPositionHelper The control position helper.
     */
    public function __construct(ControlPositionHelper $controlPositionHelper = null)
    {
        parent::__construct();

        if ($controlPositionHelper === null) {
            $controlPositionHelper = new ControlPositionHelper();
        }

        $this->setControlPositionHelper($controlPositionHelper);
    }

    /**
     * Gets the control position helper.
     *
     * @return \Fungio\GoogleMap\Helper\Controls\ControlPositionHelper The control position helper.
     */
    public function getControlPositionHelper()
    {
        return $this->controlPositionHelper;
    }

    /**
     * Sets the control position helper.
     *
     * @param \Fungio\GoogleMap\Helper\Controls\ControlPositionHelper $controlPositionHelper The control position helper.
     */
    public function setControlPositionHelper(ControlPositionHelper $controlPositionHelper)
    {
        $this->controlPositionHelper = $controlPositionHelper;
    }

    /**
     * Renders the street view control
     *
     * @param Fungio\GoogleMapBundle\Model\Controls\StreetViewControl $streetViewControl
     * @return string HTML output
     */
    public function render(StreetViewControl $streetViewControl)
    {
        return $this->jsonBuilder
            ->reset()
            ->setValue(
                '[position]',
                $this->controlPositionHelper->render($streetViewControl->getControlPosition()),
                false
            )
            ->build();
    }
}
