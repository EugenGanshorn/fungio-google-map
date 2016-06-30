<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Helper\Layers;

use Fungio\GoogleMap\Layers\KMLLayer;
use Fungio\GoogleMap\Helper\Layers\KMLLayerHelper;

/**
 * KML Layer helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KMLLayerHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Layers\KMLLayerHelper */
    protected $kmlLayerHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->kmlLayerHelper = new KMLLayerHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->kmlLayerHelper);
    }

    public function testRenderWithoutOptions()
    {
        $map = $this->getMock('Fungio\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $kmlLayer = new KMLLayer('url');
        $kmlLayer->setJavascriptVariable('kmlLayer');

        $this->assertSame(
            'kmlLayer = new google.maps.KmlLayer("url", {"map":map});'.PHP_EOL,
            $this->kmlLayerHelper->render($kmlLayer, $map)
        );
    }

    public function testRenderWithOptions()
    {
        $map = $this->getMock('Fungio\GoogleMap\Map');
        $map
            ->expects($this->once())
            ->method('getJavascriptVariable')
            ->will($this->returnValue('map'));

        $kmlLayer = new KMLLayer('url');
        $kmlLayer->setJavascriptVariable('kmlLayer');
        $kmlLayer->setOptions(array('option1' => 'value1', 'option2' => 'value2'));

        $expected = 'kmlLayer = new google.maps.KmlLayer('.
            '"url", '.
            '{"map":map,"option1":"value1","option2":"value2"}'.
            ');'.PHP_EOL;

        $this->assertSame($expected, $this->kmlLayerHelper->render($kmlLayer, $map));
    }
}
