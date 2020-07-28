<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Helper;

/**
 * Google Map API helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiHelper extends AbstractHelper
{
    /** @var boolean */
    protected $loaded;

    /** @var string */
    protected $apiKey;

    /**
     * Creates a Google Map API helper.
     */
    public function __construct()
    {
        parent::__construct();

        $this->loaded = false;
        $this->apiKey = '';
    }

    /**
     * Checks/Sets if the API is already loaded.
     *
     * @param boolean $loaded TRUE if the API is already loaded else FALSE.
     *
     * @return boolean TRUE if the API is already loaded else FALSE.
     */
    public function isLoaded($loaded = null)
    {
        if ($loaded !== null) {
            $this->loaded = (bool)$loaded;
        }

        return $this->loaded;
    }

    /**
     * @param $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Renders the API.
     *
     * @param string $language The language.
     * @param array $libraries Additionnal libraries.
     * @param string $callback A JS callback.
     * @param boolean $sensor The sensor flag.
     *
     * @return string The HTML output.
     */
    public function render(
        $language = 'en',
        array $libraries = array(),
        $callback = null,
        $sensor = false
    )
    {
        $otherParameters = array();

        if (!empty($libraries)) {
            $otherParameters['libraries'] = implode(',', $libraries);
        }

        $otherParameters['language'] = $language;
        if ($this->apiKey != '') {
            $otherParameters['key'] = $this->apiKey;
        }
//        $otherParameters['sensor'] = json_encode((bool) $sensor);

        $this->jsonBuilder
            ->reset()
            ->setValue('[other_params]', urldecode(http_build_query($otherParameters)));

        if ($callback !== null) {
            $this->jsonBuilder->setValue('[callback]', $callback, false);
        }

        $params = json_decode($this->jsonBuilder->build(), true);
        $url = sprintf('//maps.googleapis.com/maps/api/js?%s', $params['other_params']);
        
        $output = array();
        $output[] = sprintf('<script type="text/javascript" src="%s"></script>' . PHP_EOL, $url);

        $this->loaded = true;

        return implode('', $output);
    }
}
