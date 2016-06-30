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

use Fungio\GoogleMap\Controls\RotateControl;
use Fungio\GoogleMap\Helper\AbstractHelper;

/**
 * Rotate control helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlHelper extends AbstractHelper
{
    /** @var \Fungio\GoogleMap\Helper\Controls\ControlPositionHelper */
    protected $controlPositionHelper;

    /**
     * Creates a rotate control helper.
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
     * Renders a rotate control.
     *
     * @param \Fungio\GoogleMap\Controls\RotateControl $rotateControl The rotate control.
     *
     * @return string The JS output.
     */
    public function render(RotateControl $rotateControl)
    {
        return $this->jsonBuilder
            ->reset()
            ->setValue('[position]', $this->controlPositionHelper->render($rotateControl->getControlPosition()), false)
            ->build();
    }
}
