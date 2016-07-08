<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Helper\Extension;

use Fungio\GoogleMap\Helper\ApiHelper;
use Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper;
use Fungio\GoogleMap\Map;

/**
 * Core extension helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoreExtensionHelper implements ExtensionHelperInterface
{
    /** @var \Fungio\GoogleMap\Helper\ApiHelper */
    protected $apiHelper;

    /** @var \Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper */
    protected $markerClusterHelper;

    /**
     * Creates a core extension helper.
     *
     * @param \Fungio\GoogleMap\Helper\ApiHelper                                  $apiHelper           The api helper.
     * @param \Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper $markerClusterHelper The marker cluster helper.
     */
    public function __construct(ApiHelper $apiHelper = null, MarkerClusterHelper $markerClusterHelper = null)
    {
        if ($apiHelper === null) {
            $apiHelper = new ApiHelper();
        }

        if ($markerClusterHelper === null) {
            $markerClusterHelper = new MarkerClusterHelper();
        }

        $this->setApiHelper($apiHelper);
        $this->setMarkerClusterHelper($markerClusterHelper);
    }

    /**
     * Gets the api helper.
     *
     * @return \Fungio\GoogleMap\Helper\ApiHelper The api helper.
     */
    public function getApiHelper()
    {
        return $this->apiHelper;
    }

    /**
     * Sets the api helper.
     *
     * @param \Fungio\GoogleMap\Helper\ApiHelper $apiHelper The api helper.
     */
    public function setApiHelper(ApiHelper $apiHelper)
    {
        $this->apiHelper = $apiHelper;
    }

    /**
     * Gets the marker cluster helper.
     *
     * @return \Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper The marker cluster helper.
     */
    public function getMarkerClusterHelper()
    {
        return $this->markerClusterHelper;
    }

    /**
     * Sets the marker cluster helper.
     *
     * @param \Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper $markerClusterHelper The marker cluster helper.
     */
    public function setMarkerClusterHelper(MarkerClusterHelper $markerClusterHelper)
    {
        $this->markerClusterHelper = $markerClusterHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function renderLibraries(Map $map)
    {
        if ($this->apiHelper->isLoaded()) {
            return;
        }

        $callback = null;

        if ($map->isAsync()) {
            $callback = 'load_fungio_google_map';
        }

        $output = array();

        $output[] = $this->apiHelper->render($map->getLanguage(), $map->getApiKey(), $this->getLibraries($map), $callback);
        $output[] = $this->markerClusterHelper->renderLibraries($map->getMarkerCluster(), $map);

        return implode('', $output);
    }

    /**
     * {@inheritdoc}
     */
    public function renderBefore(Map $map)
    {
        if ($map->isAsync()) {
            return 'function load_fungio_google_map() {'.PHP_EOL;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renderAfter(Map $map)
    {
        if ($map->isAsync()) {
            return '}'.PHP_EOL;
        }
    }

    /**
     * Gets the libraries needed for the map.
     *
     * @param \Fungio\GoogleMap\Map $map The map.
     *
     * @return array The map libraries.
     */
    protected function getLibraries(Map $map)
    {
        $libraries = $map->getLibraries();

        $encodedPolylines = $map->getEncodedPolylines();
        if (!empty($encodedPolylines)) {
            $libraries[] = 'geometry';
        }

        return array_unique($libraries);
    }
}
