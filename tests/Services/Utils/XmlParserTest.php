<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Services\Utils;

use Fungio\GoogleMap\Services\Utils\XmlParser;

/**
 * Xml parser test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class XmlParserTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Services\Utils\XmlParser */
    protected $xmlParser;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->xmlParser = new XmlParser();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->xmlParser);
    }

    public function testParse()
    {
        $xml = '<response><foo>bar</foo></response>';

        $expected = new \stdClass();
        $expected->foo = 'bar';

        $this->assertEquals($expected, $this->xmlParser->parse($xml));
    }

    public function testParsePluralized()
    {
        $xml = '<response><foo>bar</foo></response>';
        $rules = array('foo' => 'foos');

        $expected = new \stdClass();
        $expected->foos = array('bar');

        $this->assertEquals($expected, $this->xmlParser->parse($xml, $rules));
    }
}
