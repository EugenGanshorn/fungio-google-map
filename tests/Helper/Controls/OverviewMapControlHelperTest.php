<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Helper\Controls;

use Fungio\GoogleMap\Controls\OverviewMapControl;
use Fungio\GoogleMap\Helper\Controls\OverviewMapControlHelper;

/**
 * Overview map control helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Controls\OverviewMapControlHelper */
    protected $overviewMapControlHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->overviewMapControlHelper = new OverviewMapControlHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->overviewMapControlHelper);
    }

    public function testRender()
    {
        $overviewMapControl = new OverviewMapControl(true);

        $this->assertSame('{"opened":true}', $this->overviewMapControlHelper->render($overviewMapControl));
    }
}
