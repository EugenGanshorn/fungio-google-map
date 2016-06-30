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

/**
 * Abstract marker cluster helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractMarkerClusterHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Overlays\MarkerCluster\AbstractMarkerClusterHelper */
    protected $helper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->helper = $this->getMockForAbstractClass('Fungio\GoogleMap\Helper\Overlays\MarkerCluster\AbstractMarkerClusterHelper');
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
        $this->assertInstanceOf('Fungio\GoogleMap\Helper\Overlays\MarkerHelper', $this->helper->getMarkerHelper());
    }

    public function testInitialState()
    {
        $markerHelper = $this->getMock('Fungio\GoogleMap\Helper\Overlays\MarkerHelper');

        $this->helper = $this->getMockBuilder('Fungio\GoogleMap\Helper\Overlays\MarkerCluster\AbstractMarkerClusterHelper')
            ->setConstructorArgs(array($markerHelper))
            ->getMockForAbstractClass();

        $this->assertSame($markerHelper, $this->helper->getMarkerHelper());
    }
}
