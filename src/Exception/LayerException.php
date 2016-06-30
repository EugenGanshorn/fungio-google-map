<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Exception;

/**
 * Layer exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class LayerException extends Exception
{
    /**
     * Gets the "INVALID KML LAYER URL" exception.
     *
     * @return \Fungio\GoogleMap\Exception\LayerException The "INVALID KML LAYER URL" exception.
     */
    public static function invalidKmlLayerUrl()
    {
        return new static('The kml layer url must be a string value.');
    }
}
