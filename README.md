# base-entity
Base Entity library

## Installation
Add the repository for this package to your composer.json file:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/allsrvs-online/base-entity"
    }
  ]
}
```
Then add the package to your require section:

```json
{
  "require": {
    "allsrvs-online/base-entity": "latest"
  }
}
```
Or by using composer:

```bash
composer require allsrvs-online/base-entity
```

## Usage
### Using the Base Entity
To use the ***Entity*** class, extend it and define your own properties and methods.
```php
namespace YourNamespace;

use AllSrvs\Base\Entity\Entity;

class YourBaseEntity extends Entity
{
    protected $properties = [];

    public function __construct(array $data = [])
    {
        $this->properties = $data;
    }

    public function getProperty($name)
    {
        return $this->properties[$name] ?? null;
    }

    public function setProperty($name, $value)
    {
        $this->properties[$name] = $value;
    }
}
```
### Defining a Modeled Entity
To define a modeled entity, extend the ***ModeledEntity*** class and define the modelFields property.
```php
namespace YourNamespace;

use AllSrvs\Base\Entity\ModeledEntity;

class YourEntity extends ModeledEntity
{
    public function __construct()
    {
        $this->modelFields = [
            'intField' => (object)['type' => 'int', 'isNullable' => false],
            'floatField' => (object)['type' => 'float', 'isNullable' => false],
            'stringField' => (object)['type' => 'string', 'isNullable' => false],
            'dateField' => (object)['type' => 'date', 'isNullable' => false],
            'datetimeField' => (object)['type' => 'datetime', 'isNullable' => false],
            'boolField' => (object)['type' => 'bool', 'isNullable' => false],
            'arrayField' => (object)['type' => 'array', 'isNullable' => false],
            'entityField' => (object)['type' => 'entity', 'isNullable' => false],
        ];
    }
}
```
### Setting Properties
You can set properties on your entity using the magic __set method. The validateProperty method will ensure the value matches the defined type.
```php
$entity = new YourEntity();
$entity->intField = 123;
$entity->floatField = 123.45;
$entity->stringField = 'string';
$entity->dateField = '2021-01-01';
$entity->datetimeField = '2021-01-01 00:00:00';
$entity->boolField = true;
$entity->arrayField = ['value1', 'value2'];
$entity->entityField = new YourBaseEntity();
```
### Getting Properties
You can get properties on your entity using the magic __get method.
```php
$intField = $entity->intField;
$floatField = $entity->floatField;
$stringField = $entity->stringField;
$dateField = $entity->dateField;
$datetimeField = $entity->datetimeField;
$boolField = $entity->boolField;
$arrayField = $entity->arrayField;
$entityField = $entity->entityField;
``` 
### Checking for Property Existence
You can check if a property exists on your entity using the magic __isset method.
```php
$exists = isset($entity->intField);
```

