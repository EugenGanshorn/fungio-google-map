<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

// Autoloads library.
$loader = require __DIR__.'/../vendor/autoload.php';

// Autoloads tests.
$loader->addPsr4('Fungio\\Tests\\GoogleMap\\', __DIR__);
