<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMap\Helper\Places;

use Fungio\GoogleMap\Exception\HelperException;
use Fungio\GoogleMap\Helper\AbstractHelper;
use Fungio\GoogleMap\Helper\ApiHelper;
use Fungio\GoogleMap\Helper\Base\CoordinateHelper;
use Fungio\GoogleMap\Helper\Base\BoundHelper;
use Fungio\GoogleMap\Places\Autocomplete;

/**
 * Places autocomplete helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteHelper extends AbstractHelper
{
    /** @var \Fungio\GoogleMap\Helper\ApiHelper */
    protected $apiHelper;

    /** @var \Fungio\GoogleMap\Helper\Base\CoordinateHelper */
    protected $coordinateHelper;

    /** @var \Fungio\GoogleMap\Helper\Base\BoundHelper */
    protected $boundHelper;

    /**
     * Creates an autocomplete helper.
     *
     * @param \Fungio\GoogleMap\Helper\ApiHelper             $apiHelper        The API helper.
     * @param \Fungio\GoogleMap\Helper\Base\CoordinateHelper $coordinateHelper The coordinate helper.
     * @param \Fungio\GoogleMap\Helper\Base\BoundHelper      $boundHelper      The bound helper.
     */
    public function __construct(
        ApiHelper $apiHelper = null,
        CoordinateHelper $coordinateHelper = null,
        BoundHelper $boundHelper = null
    )
    {
        parent::__construct();

        if ($apiHelper === null) {
            $apiHelper = new ApiHelper();
        }

        if ($coordinateHelper === null) {
            $coordinateHelper = new CoordinateHelper();
        }

        if ($boundHelper === null) {
            $boundHelper = new BoundHelper();
        }

        $this->setApiHelper($apiHelper);
        $this->setCoordinateHelper($coordinateHelper);
        $this->setBoundHelper($boundHelper);
    }

    /**
     * Gets the API helper.
     *
     * @return \Fungio\GoogleMap\Helper\ApiHelper The API helper.
     */
    public function getApiHelper()
    {
        return $this->apiHelper;
    }

    /**
     * Sets the API helper.
     *
     * @param \Fungio\GoogleMap\Helper\ApiHelper $apiHelper The API helper.
     */
    public function setApiHelper(ApiHelper $apiHelper)
    {
        $this->apiHelper = $apiHelper;
    }

    /**
     * Gets the coordinate helper.
     *
     * @return \Fungio\GoogleMap\Helper\Base\CoordinateHelper The coordinate helper.
     */
    public function getCoordinateHelper()
    {
        return $this->coordinateHelper;
    }

    /**
     * Sets the coordinate helper.
     *
     * @param \Fungio\GoogleMap\Helper\Base\CoordinateHelper $coordinateHelper The coordinate helper.
     */
    public function setCoordinateHelper(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Gets the bound helper.
     *
     * @return \Fungio\GoogleMap\Helper\Base\BoundHelper The bound helper.
     */
    public function getBoundHelper()
    {
        return $this->boundHelper;
    }

    /**
     * Sets the bound helper.
     *
     * @param \Fungio\GoogleMap\Helper\Base\BoundHelper $boundHelper The bound helper.
     */
    public function setBoundHelper(BoundHelper $boundHelper)
    {
        $this->boundHelper = $boundHelper;
    }

    /**
     * Renders the autocomplete HTML container.
     *
     * @param \Fungio\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     *
     * @return string The HTML output.
     */
    public function renderHtmlContainer(Autocomplete $autocomplete)
    {
        $inputAttributes = $autocomplete->getInputAttributes();

        $inputAttributes['id'] = $autocomplete->getInputId();

        if ($autocomplete->hasValue()) {
            $inputAttributes['value'] = $autocomplete->getValue();
        }

        $htmlAttributes = array();
        foreach ($inputAttributes as $attribute => $value) {
            $htmlAttributes[] = sprintf('%s="%s"', $attribute, $value);
        }

        return sprintf('<input %s />'.PHP_EOL, implode(' ', $htmlAttributes));
    }

    /**
     * Renders the autocomplete javascripts.
     *
     * @param \Fungio\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     *
     * @throws \Fungio\GoogleMap\Exception\HelperException if the autocomplete bound does not have coordinates.
     *
     * @return string The HTML output.
     */
    public function renderJavascripts(Autocomplete $autocomplete)
    {
        $output = array();

        if (!$this->apiHelper->isLoaded() && !$autocomplete->isAsync()) {
            $output[] = $this->apiHelper->render($autocomplete->getLanguage(), array('places'));
        }

        $output[] = '<script type="text/javascript">'.PHP_EOL;

        if ($autocomplete->isAsync()) {
            $output[] = 'function load_fungio_google_place () {'.PHP_EOL;
        }

        if ($autocomplete->hasBound()) {
            if (!$autocomplete->getBound()->hasCoordinates()) {
                throw HelperException::invalidAutocompleteBound();
            }

            $output[] = $this->coordinateHelper->render($autocomplete->getBound()->getSouthWest());
            $output[] = $this->coordinateHelper->render($autocomplete->getBound()->getNorthEast());
            $output[] = $this->boundHelper->render($autocomplete->getBound());
        }

        $output[] = $this->renderAutocomplete($autocomplete);

        if ($autocomplete->isAsync()) {
            $output[] = '}'.PHP_EOL;
        }

        $output[] = '</script>'.PHP_EOL;

        if (!$this->apiHelper->isLoaded() && $autocomplete->isAsync()) {
            $output[] = $this->apiHelper->render(
                $autocomplete->getLanguage(),
                array('places'),
                'load_fungio_google_place'
            );
        }

        return implode('', $output);
    }

    /**
     * Renders the autocomplete.
     *
     * @param \Fungio\GoogleMap\Places\Autocomplete $autocomplete The autocomplete.
     *
     * @return string The JS output.
     */
    public function renderAutocomplete(Autocomplete $autocomplete)
    {
        $this->jsonBuilder->reset();

        if ($autocomplete->hasTypes()) {
            $this->jsonBuilder->setValue('[types]', $autocomplete->getTypes());
        }

        if ($autocomplete->hasBound()) {
            $this->jsonBuilder->setValue('[bounds]', $autocomplete->getBound()->getJavascriptVariable(), false);
        }

        if ($autocomplete->hasComponentRestrictions()) {
            $this->jsonBuilder->setValue('[componentRestrictions]', $autocomplete->getComponentRestrictions());
        }

        if (!$this->jsonBuilder->hasValues()) {
            $this->jsonBuilder->setJsonEncodeOptions(JSON_FORCE_OBJECT);
        }

        return sprintf(
            '%s = new google.maps.places.Autocomplete(document.getElementById(\'%s\'), %s);'.PHP_EOL,
            $autocomplete->getJavascriptVariable(),
            $autocomplete->getInputId(),
            $this->jsonBuilder->build()
        );
    }
}
