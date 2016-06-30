<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Services\DistanceMatrix;

use Fungio\GoogleMap\Services\DistanceMatrix\DistanceMatrixStatus;

/**
 * Distance matrix status test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsMatrixStatusTest extends \PHPUnit_Framework_TestCase
{
    public function testDistanceMatrixStatus()
    {
        $expected = array(
            DistanceMatrixStatus::INVALID_REQUEST,
            DistanceMatrixStatus::MAX_DIMENSIONS_EXCEEDED,
            DistanceMatrixStatus::MAX_ELEMENTS_EXCEEDED,
            DistanceMatrixStatus::OK,
            DistanceMatrixStatus::OVER_QUERY_LIMIT,
            DistanceMatrixStatus::REQUEST_DENIED,
            DistanceMatrixStatus::UNKNOWN_ERROR,
        );

        $this->assertSame($expected, DistanceMatrixStatus::getDistanceMatrixStatus());
    }
}
