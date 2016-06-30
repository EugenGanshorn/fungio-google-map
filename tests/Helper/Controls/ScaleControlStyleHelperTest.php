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

use Fungio\GoogleMap\Controls\ScaleControlStyle;
use Fungio\GoogleMap\Helper\Controls\ScaleControlStyleHelper;

/**
 * Scale control style helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlStyleHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var Fungio\GoogleMap\Helper\Controls\ScaleControlStyleHelper */
    protected $scaleControlStyleHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->scaleControlStyleHelper = new ScaleControlStyleHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->scaleControlStyleHelper);
    }

    public function testRenderWithValidValue()
    {
        $this->assertSame(
            'google.maps.ScaleControlStyle.DEFAULT',
            $this->scaleControlStyleHelper->render(ScaleControlStyle::DEFAULT_)
        );
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\HelperException
     * @expectedExceptionMessage The scale control style can only be : default.
     */
    public function testRenderWithInvalidValue()
    {
        $this->scaleControlStyleHelper->render('foo');
    }
}
