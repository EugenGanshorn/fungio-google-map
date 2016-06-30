<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Helper\Overlays\MarkerCluster;

use Fungio\GoogleMap\Helper\AbstractHelper;
use Fungio\GoogleMap\Helper\Overlays\MarkerHelper;

/**
 * Abstract marker cluster helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractMarkerClusterHelper extends AbstractHelper implements MarkerClusterHelperInterface
{
    /** @var \Fungio\GoogleMap\Helper\Overlays\MarkerHelper */
    protected $markerHelper;

    /**
     * Creates a default marker cluster helper.
     *
     * @param \Fungio\GoogleMap\Helper\Overlays\MarkerHelper $markerHelper The marker helper.
     */
    public function __construct(MarkerHelper $markerHelper = null)
    {
        parent::__construct();

        if ($markerHelper === null) {
            $markerHelper = new MarkerHelper();
        }

        $this->setMarkerHelper($markerHelper);
    }

    /**
     * Gets the marker helper.
     *
     * @return \Fungio\GoogleMap\Helper\Overlays\MarkerHelper The marker helper.
     */
    public function getMarkerHelper()
    {
        return $this->markerHelper;
    }

    /**
     * Sets the marker helper.
     *
     * @param \Fungio\GoogleMap\Helper\Overlays\MarkerHelper $markerHelper The marker helper.
     */
    public function setMarkerHelper(MarkerHelper $markerHelper)
    {
        $this->markerHelper = $markerHelper;
    }
}
