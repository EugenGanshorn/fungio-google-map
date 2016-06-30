# Distance Matrix Request

## Build a distance matrix request

``` php
use Fungio\GoogleMap\Base\Coordinate;
use Fungio\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest;
use Fungio\GoogleMap\Services\Base\TravelMode;
use Fungio\GoogleMap\Services\Base\UnitSystem;

$request = new DistanceMatrixRequest();

// Set your origins
$request->setOrigins(array('New York'));
$request->setOrigins(array(new Coordinate(1.1, 2.1, true)));

// Set your destinations
$request->setDestinations(array('Washington'));
$request->setDestinations(array(new Coordinate(2.1, 1.1, true)));

$request->setAvoidHighways(true);
$request->setAvoidTolls(true);

$request->setRegion('us');
$request->setLanguage('en');
$request->setTravelMode(TravelMode::DRIVING);
$request->setUnitSystem(UnitSystem::METRIC);
$request->setSensor(false);
```

## Process your request

``` php
use Fungio\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest;

$request = new DistanceMatrixRequest();

// Process your request
$response = $distanceMatrix->process($request);
```
