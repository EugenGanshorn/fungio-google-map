<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Places;

/**
 * Places autocomplete component restriction.
 *
 * @author GeLo <geloen.eric@gmail.com>
 * @author Semyon Velichko <semyon@velichko.net>
 */
class AutocompleteComponentRestriction
{
    const COUNTRY = 'country';

    /**
     * Disabled constructor.
     *
     * @codeCoverageIgnore
     */
    final private function __construct()
    {
    }

    /**
     * Gets the available component restrictions.
     *
     * @return array The available component restrictions.
     */
    public static function getAvailableAutocompleteComponentRestrictions()
    {
        return array(
            self::COUNTRY,
        );
    }
}