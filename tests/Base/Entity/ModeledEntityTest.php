<?php

namespace Tests\Base\Entity;

use AllSrvs\Base\Entity\Entity;
use PHPUnit\Framework\TestCase;
use AllSrvs\Base\Entity\ModeledEntity;
use Tests\Utils\PHPUnitUtil;

class ModeledEntityTest extends TestCase
{
    protected array $modeledEntityFields;
    protected ModeledEntity $modeledEntity;
    protected function setUp(): void
    {
        $this->modeledEntityFields = [
            'intField' => (object)['type' => 'int', 'isNullable' => false],
            'floatField' => (object)['type' => 'float', 'isNullable' => false],
            'stringField' => (object)['type' => 'string', 'isNullable' => false],
            'dateField' => (object)['type' => 'date', 'isNullable' => false],
            'datetimeField' => (object)['type' => 'datetime', 'isNullable' => false],
            'boolField' => (object)['type' => 'bool', 'isNullable' => false],
            'arrayField' => (object)['type' => 'array', 'isNullable' => false],
            'entityField' => (object)['type' => 'entity', 'isNullable' => false],
        ];

        $this->modeledEntity = new ModeledEntity($this->modeledEntityFields, []);
    }
    public function testConstructorWithCorrectFields()
    {
        $data = ['intField' => 123, 'floatField' => 123.45, 'stringField' => 'test', 'dateField' => '2023-10-05', 'datetimeField' => '2023-10-05 14:30:00', 'boolField' => true, 'arrayField' => ['entry', 'entry'], 'entityField' => ['key' => 'value']];
        $entity = new ModeledEntity($this->modeledEntityFields, $data);
        $this->assertEquals(123, $entity->intField);
        $this->assertEquals(123.45, $entity->floatField);
    }

    public function testConstructorWithIncorrectFields()
    {
        $this->expectException(\InvalidArgumentException::class);
        $data = ['nonExistingField' => 'nonExisting'];
        new ModeledEntity($this->modeledEntityFields, $data);
    }

    public function testSetIntField()
    {
        $this->modeledEntity->intField = 123;
        $this->assertEquals(123, $this->modeledEntity->intField);
    }

    public function testSetFloatField()
    {
        $this->modeledEntity->floatField = 123.45;
        $this->assertEquals(123.45, $this->modeledEntity->floatField);
    }

    public function testSetStringField()
    {
        $this->modeledEntity->stringField = 'test';
        $this->assertEquals('test', $this->modeledEntity->stringField);
    }

    public function testSetDateField()
    {
        $this->modeledEntity->dateField = '2023-10-05';
        $this->assertEquals('2023-10-05', $this->modeledEntity->dateField);
    }

    public function testSetDatetimeField()
    {
        $this->modeledEntity->datetimeField = '2023-10-05 14:30:00';
        $this->assertEquals('2023-10-05 14:30:00', $this->modeledEntity->datetimeField);
    }

    public function testSetBoolField()
    {
        $this->modeledEntity->boolField = true;
        $this->assertTrue($this->modeledEntity->boolField);
    }

    public function testSetArrayField()
    {
        $this->modeledEntity->arrayField = ['entry', 'entry'];
        $this->assertEquals(['entry', 'entry'], $this->modeledEntity->arrayField);
    }

    public function testSetEntityField()
    {
        $this->modeledEntity->entityField = ['key' => 'value'];
        $this->assertInstanceOf(Entity::class, $this->modeledEntity->entityField);
    }

    public function testValidateProperty()
    {
        PHPUnitUtil::callMethod($this->modeledEntity, 'validateProperty', ['intField', 123]);
        PHPUnitUtil::callMethod($this->modeledEntity, 'validateProperty', ['floatField', 123.45]);
        PHPUnitUtil::callMethod($this->modeledEntity, 'validateProperty', ['stringField', 'test']);
        PHPUnitUtil::callMethod($this->modeledEntity, 'validateProperty', ['dateField', '2023-10-05']);
        PHPUnitUtil::callMethod($this->modeledEntity, 'validateProperty', ['datetimeField', '2023-10-05 14:30:00']);
        PHPUnitUtil::callMethod($this->modeledEntity, 'validateProperty', ['boolField', true]);
        PHPUnitUtil::callMethod($this->modeledEntity, 'validateProperty', ['arrayField', ['entry', 'entry']]);
        PHPUnitUtil::callMethod($this->modeledEntity, 'validateProperty', ['entityField', ['key' => 'value']]);
        $this->assertTrue(true);
    }

    public function testInvalidIntField()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->modeledEntity->intField = 'not an int';
    }

    public function testInvalidFloatField()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->modeledEntity->floatField = 'not a float';
    }

    public function testInvalidStringField()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->modeledEntity->stringField = 123;
    }

    public function testInvalidDateField()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->modeledEntity->dateField = 'invalid date';
    }

    public function testInvalidDatetimeField()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->modeledEntity->datetimeField = 'invalid datetime';
    }

    public function testInvalidBoolField()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->modeledEntity->boolField = 'not a bool';
    }

    public function testInvalidArrayField()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->modeledEntity->arrayField = 'not an array';
    }

    public function testInvalidEntityField()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->modeledEntity->entityField = ['not', 'an', 'associative', 'array'];
    }


}