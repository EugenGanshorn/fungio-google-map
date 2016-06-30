<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Helper\Extension;

use Fungio\GoogleMap\Map;

/**
 * Extension helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
interface ExtensionHelperInterface
{
    /**
     * Renders libraires.
     *
     * @param \Fungio\GoogleMap\Map $map The map.
     *
     * @return string The html output.
     */
    public function renderLibraries(Map $map);

    /**
     * Renders JS code just before the generated one.
     *
     * @param \Fungio\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderBefore(Map $map);

    /**
     * Renders JS code just after the generated one.
     *
     * @param \Fungio\GoogleMap\Map $map The map.
     *
     * @return string The JS output.
     */
    public function renderAfter(Map $map);
}
