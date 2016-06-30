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

use Fungio\GoogleMap\Controls\ScaleControl;
use Fungio\GoogleMap\Helper\AbstractHelper;

/**
 * Scale control helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlHelper extends AbstractHelper
{
    /** @var \Fungio\GoogleMap\Helper\Controls\ControlPositionHelper */
    protected $controlPositionHelper;

    /** @var \Fungio\GoogleMap\Helper\Controls\ScaleControleStyleHelper */
    protected $scaleControlStyleHelper;

    /**
     * Construct a scale control helper.
     *
     * @param \Fungio\GoogleMap\Helper\Controls\ControlPositionHelper    $controlPositionHelper   The control position
     *                                                                                           helper.
     * @param \Fungio\GoogleMap\Helper\Controls\ScaleControleStyleHelper $scaleControlStyleHelper The scale control
     *                                                                                           style helper.
     */
    public function __construct(
        ControlPositionHelper $controlPositionHelper = null,
        ScaleControlStyleHelper $scaleControlStyleHelper = null
    ) {
        parent::__construct();

        if ($controlPositionHelper === null) {
            $controlPositionHelper = new ControlPositionHelper();
        }

        if ($scaleControlStyleHelper === null) {
            $scaleControlStyleHelper = new ScaleControlStyleHelper();
        }

        $this->setControlPositionHelper($controlPositionHelper);
        $this->setScaleControlStyleHelper($scaleControlStyleHelper);
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
     * Gets the scale control style helper.
     *
     * @return \Fungio\GoogleMap\Helper\Controls\ScaleControlStyleHelper The scale control style helper.
     */
    public function getScaleControlStyleHelper()
    {
        return $this->scaleControlStyleHelper;
    }

    /**
     * Sets the scale control style helper.
     *
     * @param \Fungio\GoogleMap\Helper\Controls\ScaleControlStyleHelper $scaleControlStyleHelper The scale control style
     *                                                                                          helper.
     */
    public function setScaleControlStyleHelper(ScaleControlStyleHelper $scaleControlStyleHelper)
    {
        $this->scaleControlStyleHelper = $scaleControlStyleHelper;
    }

    /**
     * Renders a scale control.
     *
     * @param \Fungio\GoogleMap\Controls\ScaleControl $scaleControl The scale control.
     *
     * @return string The JS output.
     */
    public function render(ScaleControl $scaleControl)
    {
        return $this->jsonBuilder
            ->reset()
            ->setValue('[position]', $this->controlPositionHelper->render($scaleControl->getControlPosition()), false)
            ->setValue('[style]', $this->scaleControlStyleHelper->render($scaleControl->getScaleControlStyle()), false)
            ->build();
    }
}
