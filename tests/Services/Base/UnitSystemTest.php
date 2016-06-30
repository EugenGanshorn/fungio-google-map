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

use Fungio\GoogleMap\Services\Base\UnitSystem;

/**
 * Unit system test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class UnitSystemTest extends \PHPUnit_Framework_TestCase
{
    public function testUnitSystems()
    {
        $expected = array(
            UnitSystem::IMPERIAL,
            UnitSystem::METRIC,
        );

        $this->assertSame($expected, UnitSystem::getUnitSystems());
    }
}
