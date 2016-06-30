<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Helper\Geometry;

use Fungio\GoogleMap\Exception\HelperException;

/**
 * Encoding helper.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#encoding
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodingHelper
{
    /**
     * Renders the decode path method.
     *
     * @param string $encodedPath The encoded path.
     *
     * @throws \Fungio\GoogleMap\Exception\HelperException If the encoded path is not valid.
     *
     * @return string The JS output.
     */
    public function renderDecodePath($encodedPath)
    {
        if (!is_string($encodedPath)) {
            throw HelperException::invalidEncodedPath();
        }

        return sprintf('google.maps.geometry.encoding.decodePath("%s")', addslashes($encodedPath));
    }
}
