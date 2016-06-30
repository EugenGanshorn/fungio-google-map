<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Helper\Overlays\MarkerCluster;

use Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper;
use Fungio\GoogleMap\Overlays\MarkerCluster;

/**
 * Marker cluster helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClusterHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelper */
    protected $helper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->helper = new MarkerClusterHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->helper);
    }

    public function testDefaultState()
    {
        $this->assertTrue($this->helper->hasHelpers());

        $this->assertTrue($this->helper->hasHelper(MarkerCluster::_DEFAULT));
        $this->assertTrue($this->helper->hasHelper(MarkerCluster::MARKER_CLUSTER));

        $this->assertCount(2, $this->helper->getHelpers());

        $this->assertInstanceOf(
            'Fungio\GoogleMap\Helper\Overlays\MarkerCluster\DefaultMarkerClusterHelper',
            $this->helper->getHelper(MarkerCluster::_DEFAULT)
        );
    }

    public function testInitialState()
    {
        $helper = $this->getMock('Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelperInterface');
        $this->helper = new MarkerClusterHelper(array('foo' => $helper));

        $this->assertSame(array('foo' => $helper), $this->helper->getHelpers());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\HelperException
     * @expectedExceptionMessage The marker cluster helper can not be resolved.
     */
    public function testHelperWithInvalidName()
    {
        $this->helper->getHelper('foo');
    }

    public function testRender()
    {
        $map = $this->getMock('Fungio\GoogleMap\Map');

        $markerCluster = $this->getMock('Fungio\GoogleMap\Overlays\MarkerCluster');
        $markerCluster
            ->expects($this->any())
            ->method('getType')
            ->will($this->returnValue('foo'));

        $helperMock = $this->getMock('Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelperInterface');
        $helperMock
            ->expects($this->once())
            ->method('render')
            ->with($this->equalTo($markerCluster), $this->equalTo($map))
            ->will($this->returnValue('bar'));

        $this->helper->setHelper('foo', $helperMock);

        $this->assertSame('bar', $this->helper->render($markerCluster, $map));
    }

    public function testRenderMarkers()
    {
        $map = $this->getMock('Fungio\GoogleMap\Map');

        $markerCluster = $this->getMock('Fungio\GoogleMap\Overlays\MarkerCluster');
        $markerCluster
            ->expects($this->any())
            ->method('getType')
            ->will($this->returnValue('foo'));

        $helperMock = $this->getMock('Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelperInterface');
        $helperMock
            ->expects($this->once())
            ->method('renderMarkers')
            ->with($this->equalTo($markerCluster), $this->equalTo($map))
            ->will($this->returnValue('bar'));

        $this->helper->setHelper('foo', $helperMock);

        $this->assertSame('bar', $this->helper->renderMarkers($markerCluster, $map));
    }

    public function testRenderLibraries()
    {
        $map = $this->getMock('Fungio\GoogleMap\Map');

        $markerCluster = $this->getMock('Fungio\GoogleMap\Overlays\MarkerCluster');
        $markerCluster
            ->expects($this->any())
            ->method('getType')
            ->will($this->returnValue('foo'));

        $helperMock = $this->getMock('Fungio\GoogleMap\Helper\Overlays\MarkerCluster\MarkerClusterHelperInterface');
        $helperMock
            ->expects($this->once())
            ->method('renderLibraries')
            ->with($this->equalTo($markerCluster), $this->equalTo($map))
            ->will($this->returnValue('bar'));

        $this->helper->setHelper('foo', $helperMock);

        $this->assertSame('bar', $this->helper->renderLibraries($markerCluster, $map));
    }
}
