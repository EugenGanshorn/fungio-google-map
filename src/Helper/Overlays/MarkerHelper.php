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

/**
 * Marker helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerHelper extends AbstractHelper
{
    /** @var \Fungio\GoogleMap\Helper\Overlays\AnimationHelper */
    protected $animationHelper;

    /**
     * Creates a marker helper.
     *
     * @param \Fungio\GoogleMap\Helper\Overlays\AnimationHelper $animationHelper The animation helper.
     */
    public function __construct(AnimationHelper $animationHelper = null)
    {
        parent::__construct();

        if ($animationHelper === null) {
            $animationHelper = new AnimationHelper();
        }

        $this->setAnimationHelper($animationHelper);
    }

    /**
     * Gets the animation helper.
     *
     * @return \Fungio\GoogleMap\Helper\Overlays\AnimationHelper The animation helper.
     */
    public function getAnimationHelper()
    {
        return $this->animationHelper;
    }

    /**
     * Sets the animation helper.
     *
     * @param \Fungio\GoogleMap\Helper\Overlays\AnimationHelper $animationHelper The animation helper.
     */
    public function setAnimationHelper(AnimationHelper $animationHelper)
    {
        $this->animationHelper = $animationHelper;
    }

    /**
     * Renders a marker.
     *
     * @param Fungio\GoogleMap\Overlays\Marker $marker The marker.
     * @param Fungio\GoogleMap\Map             $map    The map.
     *
     * @return string The JS output.
     */
    public function render(Marker $marker, Map $map = null)
    {
        $this->jsonBuilder
            ->reset()
            ->setValue('[position]', $marker->getPosition()->getJavascriptVariable(), false);

        if ($map !== null) {
            $this->jsonBuilder->setValue('[map]', $map->getJavascriptVariable(), false);
        }

        if ($marker->hasAnimation()) {
            $this->jsonBuilder->setValue('[animation]', $this->animationHelper->render($marker->getAnimation()), false);
        }

        if ($marker->hasIcon()) {
            $this->jsonBuilder->setValue('[icon]', $marker->getIcon()->getJavascriptVariable(), false);
        }

        if ($marker->hasShadow()) {
            $this->jsonBuilder->setValue('[shadow]', $marker->getShadow()->getJavascriptVariable(), false);
        }

        if ($marker->hasShape()) {
            $this->jsonBuilder->setValue('[shape]', $marker->getShape()->getJavascriptVariable(), false);
        }

        $this->jsonBuilder->setValues($marker->getOptions());

        return sprintf(
            '%s = new google.maps.Marker(%s);'.PHP_EOL,
            $marker->getJavascriptVariable(),
            $this->jsonBuilder->build()
        );
    }
}
