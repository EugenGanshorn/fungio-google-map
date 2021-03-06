<?php

/*
 * This file is part of the Fungio Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\Tests\GoogleMap\Places;

use Fungio\GoogleMap\Places\Autocomplete;
use Fungio\GoogleMap\Places\AutocompleteComponentRestriction;
use Fungio\GoogleMap\Places\AutocompleteType;

/**
 * Autocomplete test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMap\Places\Autocomplete */
    protected $autocomplete;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->autocomplete = new Autocomplete();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->autocomplete);
    }

    public function testDefaultState()
    {
        $this->assertSame('place_input', $this->autocomplete->getInputId());
        $this->assertFalse($this->autocomplete->hasBound());
        $this->assertFalse($this->autocomplete->hasTypes());
        $this->assertFalse($this->autocomplete->hasComponentRestrictions());
        $this->assertFalse($this->autocomplete->hasValue());
        $this->assertSame(array('type' => 'text', 'placeholder' => 'off'), $this->autocomplete->getInputAttributes());
        $this->assertFalse($this->autocomplete->isAsync());
        $this->assertSame('en', $this->autocomplete->getLanguage());
    }

    public function testInputIdWithValidValue()
    {
        $this->autocomplete->setInputId('input');

        $this->assertSame('input', $this->autocomplete->getInputId());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete input ID must be a string value.
     */
    public function testInputIdWithInvalidValue()
    {
        $this->autocomplete->setInputId(true);
    }

    public function testBoundWithBound()
    {
        $bound = $this->getMock('Fungio\GoogleMap\Base\Bound');
        $this->autocomplete->setBound($bound);

        $this->assertSame($bound, $this->autocomplete->getBound());
    }

    public function testBoundWithCoordinates()
    {
        $southWestCoordinate = $this->getMock('Fungio\GoogleMap\Base\Coordinate');
        $northEastCoordinate = $this->getMock('Fungio\GoogleMap\Base\Coordinate');

        $this->autocomplete->setBound($southWestCoordinate, $northEastCoordinate);

        $this->assertSame($southWestCoordinate, $this->autocomplete->getBound()->getSouthWest());
        $this->assertSame($northEastCoordinate, $this->autocomplete->getBound()->getNorthEast());
    }

    public function testBoundWithLatitudesAndLongitudes()
    {
        $this->autocomplete->setBound(1, 2, 3, 4, true, false);

        $this->assertSame(1, $this->autocomplete->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $this->autocomplete->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($this->autocomplete->getBound()->getSouthWest()->isNoWrap());

        $this->assertEquals(3, $this->autocomplete->getBound()->getNorthEast()->getLatitude());
        $this->assertEquals(4, $this->autocomplete->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($this->autocomplete->getBound()->getNorthEast()->isNoWrap());
    }

    public function testBoundWithNullValue()
    {
        $this->autocomplete->setBound(1, 2, 3, 4);
        $this->autocomplete->setBound(null);

        $this->assertNull($this->autocomplete->getBound());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The bound setter arguments is invalid.
     * The available prototypes are :
     * - function setBound(Fungio\GoogleMap\Base\Bound $bound)
     * - function setBount(Fungio\GoogleMap\Base\Coordinate $southWest, Fungio\GoogleMap\Base\Coordinate $northEast)
     * - function setBound(
     *     double $southWestLatitude,
     *     double $southWestLongitude,
     *     double $northEastLatitude,
     *     double $northEastLongitude,
     *     boolean southWestNoWrap = true,
     *     boolean $northEastNoWrap = true
     * )
     */
    public function testBoundWithInvalidValue()
    {
        $this->autocomplete->setBound('foo');
    }

    public function testTypesWithValidTypes()
    {
        $types = array(AutocompleteType::ESTABLISHMENT, AutocompleteType::GEOCODE);
        $this->autocomplete->setTypes($types);

        $this->assertSame($types, $this->autocomplete->getTypes());

        $this->assertTrue($this->autocomplete->hasTypes());
        $this->assertTrue($this->autocomplete->hasType(AutocompleteType::ESTABLISHMENT));
    }

    /**
     * @expectedException Fungio\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete type can only be: establishment, geocode, (regions), (cities).
     */
    public function testAddTypeWithInvalidType()
    {
        $this->autocomplete->addType('foo');
    }

    /**
     * @expectedException Fungio\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete type "establishment" already exists.
     */
    public function testAddTypeWithExistingType()
    {
        $this->autocomplete->addType(AutocompleteType::ESTABLISHMENT);
        $this->autocomplete->addType(AutocompleteType::ESTABLISHMENT);
    }

    public function testRemoveTypeWithValidType()
    {
        $this->autocomplete->addType(AutocompleteType::ESTABLISHMENT);
        $this->autocomplete->removeType(AutocompleteType::ESTABLISHMENT);

        $this->assertFalse($this->autocomplete->hasType(AutocompleteType::ESTABLISHMENT));
    }

    /**
     * @expectedException Fungio\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete type "establishment" does not exist.
     */
    public function testRemoveTypeWithNonExistingType()
    {
        $this->autocomplete->removeType(AutocompleteType::ESTABLISHMENT);
    }

    public function testComponentRestrictionsWithValidComponentRestrictions()
    {
        $componentRestrictions = array(AutocompleteComponentRestriction::COUNTRY => 'fr');
        $this->autocomplete->setComponentRestrictions($componentRestrictions);

        $this->assertSame($componentRestrictions, $this->autocomplete->getComponentRestrictions());

        $this->assertTrue($this->autocomplete->hasComponentRestrictions());
        $this->assertSame($componentRestrictions, $this->autocomplete->getComponentRestrictions());

        $this->assertTrue($this->autocomplete->hasComponentRestriction(AutocompleteComponentRestriction::COUNTRY));
        $this->assertSame(
            $componentRestrictions[AutocompleteComponentRestriction::COUNTRY],
            $this->autocomplete->getComponentRestriction(AutocompleteComponentRestriction::COUNTRY)
        );
    }

    /**
     * @expectedException Fungio\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete component restriction type "country" does not exist.
     */
    public function testComponentRestrictionsWithInvalidComponentRestrictions()
    {
        $this->autocomplete->getComponentRestriction(AutocompleteComponentRestriction::COUNTRY);
    }

    /**
     * @expectedException Fungio\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete component restriction can only be: country.
     */
    public function testAddComponentRestrictionWithInvalidComponentRestrictions()
    {
        $this->autocomplete->addComponentRestriction('foo', 'bar');
    }

    /**
     * @expectedException Fungio\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete component restriction type "country" already exists.
     */
    public function testAddComponentRestrictionWithExistingComponentRestriction()
    {
        $this->autocomplete->addComponentRestriction(AutocompleteComponentRestriction::COUNTRY, 'foo');
        $this->autocomplete->addComponentRestriction(AutocompleteComponentRestriction::COUNTRY, 'bar');
    }

    public function testRemoveComponentRestrictionWithValidComponentRestriction()
    {
        $this->autocomplete->addComponentRestriction(AutocompleteComponentRestriction::COUNTRY, 'foo');
        $this->autocomplete->removeComponentRestriction(AutocompleteComponentRestriction::COUNTRY);

        $this->assertFalse($this->autocomplete->hasComponentRestriction(AutocompleteComponentRestriction::COUNTRY));
    }

    /**
     * @expectedException Fungio\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete component restriction type "country" does not exist.
     */
    public function testRemoveComponentRestrictionWithNonExistingComponentRestriction()
    {
        $this->autocomplete->removeComponentRestriction(AutocompleteComponentRestriction::COUNTRY);
    }

    public function testInputAttributesWithValidValue()
    {
        $this->autocomplete->setInputAttributes(array('foo' => 'bar'));

        $inputAttributes = $this->autocomplete->getInputAttributes();

        $this->assertArrayHasKey('foo', $inputAttributes);
        $this->assertSame('bar', $inputAttributes['foo']);
    }

    public function testInputAttributesWithNullValue()
    {
        $this->autocomplete->setInputAttribute('foo', 'bar');
        $this->autocomplete->setInputAttribute('foo', null);

        $this->assertArrayNotHasKey('foo', $this->autocomplete->getInputAttributes());
    }

    public function testAsyncWithValidValue()
    {
        $this->autocomplete->setAsync(true);

        $this->assertTrue($this->autocomplete->isAsync());
    }

    /**
     * @expectedException \Fungio\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The asynchronous load of a place autocomplete must be a boolean value.
     */
    public function testAsyncWithInvalidValue()
    {
        $this->autocomplete->setAsync('foo');
    }

    public function testLanguage()
    {
        $this->autocomplete->setLanguage('fr');

        $this->assertSame('fr', $this->autocomplete->getLanguage());
    }
}
