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
use Fungio\GoogleMap\Overlays\EncodedPolyline;
use Fungio\GoogleMap\Helper\Geometry\EncodingHelper;

/**
 * Encoded polyline helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineHelper extends AbstractHelper
{
    /** @var \Fungio\GoogleMap\Helper\Geometry\EncodingHelper */
    protected $encodingHelper;

    /**
     * Creates an encoded polyline helper.
     *
     * @param \Fungio\GoogleMap\Helper\Geometry\EncodingHelper $encodingHelper The encoding helper.
     */
    public function __construct(EncodingHelper $encodingHelper = null)
    {
        parent::__construct();

        if ($encodingHelper === null) {
            $encodingHelper = new EncodingHelper();
        }

        $this->setEncodingHelper($encodingHelper);
    }

    /**
     * Gets the encoding helper.
     *
     * @return \Fungio\GoogleMap\Helper\Geometry\EncodingHelper The encoding helper.
     */
    public function getEncodingHelper()
    {
        return $this->encodingHelper;
    }

    /**
     * Sets the encoding helper.
     *
     * @param \Fungio\GoogleMap\Helper\Geometry\EncodingHelper $encodingHelper The encoding helper.
     */
    public function setEncodingHelper(EncodingHelper $encodingHelper)
    {
        $this->encodingHelper = $encodingHelper;
    }

    /**
     * Renders an encoded polyline.
     *
     * @param \Fungio\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline.
     * @param \Fungio\GoogleMap\Map                      $map             The map.
     *
     * @return string The JS output.
     */
    public function render(EncodedPolyline $encodedPolyline, Map $map)
    {
        $this->jsonBuilder
            ->reset()
            ->setValue('[map]', $map->getJavascriptVariable(), false)
            ->setValue('[path]', $this->encodingHelper->renderDecodePath($encodedPolyline->getValue()), false)
            ->setValues($encodedPolyline->getOptions());

        return sprintf(
            '%s = new google.maps.Polyline(%s);'.PHP_EOL,
            $encodedPolyline->getJavascriptVariable(),
            $this->jsonBuilder->build()
        );
    }
}
