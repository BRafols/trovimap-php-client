# Trovimap PHP client

Simple client to interact with trovimap evaluation API

## SETUP

```
use Trovimap\Propertista\TrovimapPhpClient\TrovimapFactory;
$client = TrovimapFactory::create();
```

## 1 Getting the cadastral unit

#### 1.1 By Address 

##### 1.1.1 Retrieve all parcels using an adress
```
$address = 'Passatge Escudellers, 7, 08002, Barcelona';
$parcels = $client->getParcelByAddress($address);
```

##### 1.1.2 get the list of the building units of a parcel, with all their apartments
```
$buildingUnits = $client->getBuildingUnitByParcelId($parcel->Id);
```

#### 1.2 get the list of the building units of the parcel that contains the apartments with the cadastral reference passed
```
$cadastralReference = '1213625DF3811C0009ZX';

$buildingUnits = $client->getBuildingUnitByCadastralReference($cadastralReference);

```

---

Now out of the buildingUnits retrieved above, we should be able to retrieve data of one `Apartment` from it's `ID`

#### 2.- Evaluate get the trovivalue of the property

#### 3.- Evaluate get the trovivalue of the property with comparables
```
use Trovimap\Propertista\TrovimapPhpClient\Models\Request\EvaluationRequest;

$apartmentId = 'asdfasdfasdfasdf';
$request = new EvaluationRequest([
    'ApartmentId' => '8_900_1213625DF3811C_001_10',
    'ParcelId' => '8_900_1213625DF3811C_0001',
    'LivingArea' => 165,
]);
$data = $client->evaluate($apartmentId, $request);
```

#### 4.- Generate the pdf report of a previous evaluation and download it.
```
$client->download('buildingUnitId', '/path/to/download/folder');
```