<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Helper\Geometry;

use Fungio\GoogleMap\Helper\Geometry\EncodingHelper;

/**
 * Encoding helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodingHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Geometry\EncodingHelper */
    protected $encodingHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodingHelper = new EncodingHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->encodingHelper);
    }

    public function testRenderDecodePathWithoutSpecialChars()
    {
        $this->assertSame(
            'google.maps.geometry.encoding.decodePath("foo")',
            $this->encodingHelper->renderDecodePath('foo')
        );
    }

    public function testRenderDecodePathWithSpecialChars()
    {
        $this->assertSame(
            'google.maps.geometry.encoding.decodePath("v\"a\\\\lu\\\'e")',
            $this->encodingHelper->renderDecodePath('v"a\lu\'e')
        );
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\HelperException
     * @expectedExceptionMessage The encoded path must be a string value.
     */
    public function testRenderDecodePathWithInvalidValue()
    {
        $this->encodingHelper->renderDecodePath(true);
    }
}
