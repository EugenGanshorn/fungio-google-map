<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Services\Base;

use Fungio\GoogleMap\Services\Base\Duration;

/**
 * Duration test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DurationTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Services\Base\Duration */
    protected $duration;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->duration = new Duration('foo', 2.2);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->duration);
    }

    public function testInitialState()
    {
        $this->assertSame('foo', $this->duration->getText());
        $this->assertSame(2.2, $this->duration->getValue());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\ServiceException
     * @expectedExceptionMessage The duration text must be a string value.
     */
    public function testTextWithInvalidValue()
    {
        $this->duration->setText(true);
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\ServiceException
     * @expectedExceptionMessage The duration value must be a numeric value.
     */
    public function testValueWithInvalidValue()
    {
        $this->duration->setValue('foo');
    }
}
