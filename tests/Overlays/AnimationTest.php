<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Overlays;

use Fungio\GoogleMap\Overlays\Animation;

/**
 * Animation test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AnimationTest extends \PHPUnit_Framework_TestCase
{
    public function testMapTypeControlStyles()
    {
        $expected = array(
            Animation::BOUNCE,
            Animation::DROP,
        );

        $this->assertSame($expected, Animation::getAnimations());
    }
}
