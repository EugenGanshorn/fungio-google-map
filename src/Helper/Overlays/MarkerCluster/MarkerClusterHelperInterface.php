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

use Fungio\GoogleMap\Map;
use Fungio\GoogleMap\Overlays\MarkerCluster;

/**
 * Marker cluster helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
interface MarkerClusterHelperInterface
{
    /**
     * Renders a marker cluster with the js map container.
     *
     * @param \Fungio\GoogleMap\Overlays\MarkerCluster $markerCluster The marker cluster.
     * @param \Fungio\GoogleMap\Map                    $map           The map
     *
     * @return string The JS output.
     */
    public function render(MarkerCluster $markerCluster, Map $map);

    /**
     * Renders the markers of a marker cluster with the js container.
     *
     * @param \Fungio\GoogleMap\Overlays\MarkerCluster $markerCluster The marker cluster.
     * @param \Fungio\GoogleMap\Map                    $map           The map.
     *
     * @return string The JS output.
     */
    public function renderMarkers(MarkerCluster $markerCluster, Map $map);

    /**
     * Renders the marker cluster libraries.
     *
     * @param \Fungio\GoogleMap\Overlays\MarkerCluster $markerCluster The marker cluster.
     * @param \Fungio\GoogleMap\Map                    $map           The map.
     *
     * @return string The html output.
     */
    public function renderLibraries(MarkerCluster $markerCluster, Map $map);
}
