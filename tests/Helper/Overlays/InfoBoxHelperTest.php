<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Helper\Overlays;

use Fungio\GoogleMap\Helper\Overlays\InfoBoxHelper;
use Fungio\GoogleMap\Overlays\InfoWindow;

/**
 * InfoBox helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoBoxHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Overlays\InfoBoxHelper */
    protected $infoBoxHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->infoBoxHelper = new InfoBoxHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->infoBoxHelper);
    }

    public function testRender()
    {
        $infoWindow = new InfoWindow();

        $infoWindow->setPosition(1.1, 2.1, true);
        $infoWindow->getPosition()->setJavascriptVariable('position');

        $infoWindow->setPixelOffset(3, 4, 'px', 'px');
        $infoWindow->getPixelOffset()->setJavascriptVariable('pixel_offset');

        $infoWindow->setContent('content');
        $infoWindow->setOpen(true);

        $infoWindow->setOptions(array('option1' => 'value1', 'option2' => 'value2'));

        $expected = $infoWindow->getJavascriptVariable().' = new InfoBox({'.
            '"position":position,'.
            '"pixelOffset":pixel_offset,'.
            '"content":"content",'.
            '"option1":"value1",'.
            '"option2":"value2"'.
            '});'.PHP_EOL;

        $this->assertSame($expected, $this->infoBoxHelper->render($infoWindow, true));
    }
}
