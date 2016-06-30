<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Helper\Extension;

use Fungio\GoogleMap\Helper\Extension\CoreExtensionHelper;
use Fungio\GoogleMap\Map;
use Fungio\GoogleMap\Overlays\EncodedPolyline;

/**
 * Core extension helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoreExtensionHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Extension\CoreExtensionHelper */
    protected $coreExtensionHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coreExtensionHelper = new CoreExtensionHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->coreExtensionHelper);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Fungio\GoogleMap\Helper\ApiHelper', $this->coreExtensionHelper->getApiHelper());
        $this->assertInstanceOf(
            'Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper',
            $this->coreExtensionHelper->getMarkerClusterHelper()
        );
    }

    public function testInitialState()
    {
        $apiHelper = $this->getMock('Fungio\GoogleMap\Helper\ApiHelper');
        $markerClusterHelper = $this->getMock('Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper');

        $this->coreExtensionHelper = new CoreExtensionHelper($apiHelper, $markerClusterHelper);

        $this->assertSame($apiHelper, $this->coreExtensionHelper->getApiHelper());
        $this->assertSame($markerClusterHelper, $this->coreExtensionHelper->getMarkerClusterHelper());
    }

    public function testRenderLibrariesWithDefaultMap()
    {
        $expected = <<<EOF
<script type="text/javascript">
function load_fungio_google_map_api () { google.load("maps", "3", {"other_params":"language=en&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_fungio_google_map_api"></script>

EOF;

        $this->assertSame($expected, $this->coreExtensionHelper->renderLibraries(new Map()));
    }

    public function testRenderLibrariesWithAsyncMap()
    {
        $map = new Map();
        $map->setAsync(true);

        $expected = <<<EOF
<script type="text/javascript">
function load_fungio_google_map_api () { google.load("maps", "3", {"other_params":"language=en&sensor=false","callback":load_fungio_google_map}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_fungio_google_map_api"></script>

EOF;

        $this->assertSame($expected, $this->coreExtensionHelper->renderLibraries($map));
    }

    public function testRenderLibrariesWithMapLibrariesAndEncodedPolylines()
    {
        $map = new Map();
        $map->setLibraries(array('places'));
        $map->addEncodedPolyline(new EncodedPolyline('foo'));

        $expected = <<<EOF
<script type="text/javascript">
function load_fungio_google_map_api () { google.load("maps", "3", {"other_params":"libraries=places,geometry&language=en&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_fungio_google_map_api"></script>

EOF;

        $this->assertSame($expected, $this->coreExtensionHelper->renderLibraries($map));
    }

    public function testRenderLibrariesWithMultipleMaps()
    {
        $expected1 = <<<EOF
<script type="text/javascript">
function load_fungio_google_map_api () { google.load("maps", "3", {"other_params":"language=en&sensor=false"}); };
</script>
<script type="text/javascript" src="//www.google.com/jsapi?callback=load_fungio_google_map_api"></script>

EOF;

        $this->assertSame($expected1, $this->coreExtensionHelper->renderLibraries(new Map()));
        $this->assertNull($this->coreExtensionHelper->renderLibraries(new Map()));
    }

    public function testRenderBeforeWithDefaultMap()
    {
        $this->assertNull($this->coreExtensionHelper->renderBefore(new Map()));
    }

    public function testRenderBeforeWithAsyncMap()
    {
        $map = new Map();
        $map->setAsync(true);

        $this->assertSame('function load_fungio_google_map() {'.PHP_EOL, $this->coreExtensionHelper->renderBefore($map));
    }

    public function testRenderAfterWithDefaultMap()
    {
        $this->assertNull($this->coreExtensionHelper->renderAfter(new Map()));
    }

    public function testRenderAfterWithAsyncMap()
    {
        $map = new Map();
        $map->setAsync(true);

        $this->assertSame('}'.PHP_EOL, $this->coreExtensionHelper->renderAfter($map));
    }
}
