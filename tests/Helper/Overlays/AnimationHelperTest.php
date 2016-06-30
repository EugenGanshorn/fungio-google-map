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

use Fungio\GoogleMap\Overlays\Animation;
use Fungio\GoogleMap\Helper\Overlays\AnimationHelper;

/**
 * Animation helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AnimationHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Helper\Overlays\AnimationHelper */
    protected $animationHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->animationHelper = new AnimationHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->animationHelper);
    }

    public function testRenderWithValidValue()
    {
        $this->assertSame('google.maps.Animation.BOUNCE', $this->animationHelper->render(Animation::BOUNCE));
        $this->assertSame('google.maps.Animation.DROP', $this->animationHelper->render(Animation::DROP));
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\HelperException
     * @expectedExceptionMessage The animation can only be : bounce, drop.
     */
    public function testRenderWithInvalidValue()
    {
        $this->animationHelper->render('foo');
    }
}
