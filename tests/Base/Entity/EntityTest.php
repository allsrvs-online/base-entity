<?php

namespace Base\Entity;

use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public function testConstructorWithAssociativeArray()
    {
        $data = ['name' => 'Example', 'value' => 42];
        $entity = new Entity($data);
        $this->assertEquals('Example', $entity->name);
        $this->assertEquals(42, $entity->value);
    }

    public function testConstructorWithNonAssociativeArray()
    {
        $this->expectException(\InvalidArgumentException::class);
        $data = ['Example', 42];
        new Entity($data);
    }

    public function testSetScalarValue()
    {
        $entity = new Entity([]);
        $entity->name = 'Example';
        $this->assertEquals('Example', $entity->name);
    }

    public function testSetAssociativeArray()
    {
        $entity = new Entity([]);
        $entity->details = ['age' => 30, 'city' => 'New York'];
        $this->assertInstanceOf(Entity::class, $entity->details);
        $this->assertEquals(30, $entity->details->age);
        $this->assertEquals('New York', $entity->details->city);
    }

    public function testSetIndexedArrayWithScalars()
    {
        $entity = new Entity([]);
        $entity->tags = ['php', 'json', 'test'];
        $this->assertEquals(['php', 'json', 'test'], $entity->tags);
    }

    public function testSetIndexedArrayWithAssociativeArrays()
    {
        $entity = new Entity([]);
        $entity->items = [
            ['name' => 'Item1', 'price' => 100],
            ['name' => 'Item2', 'price' => 200]
        ];
        $this->assertCount(2, $entity->items);
        $this->assertInstanceOf(Entity::class, $entity->items[0]);
        $this->assertEquals('Item1', $entity->items[0]->name);
        $this->assertEquals(100, $entity->items[0]->price);
    }

    public function testSetIndexedArrayWithEntities()
    {
        $entity = new Entity([]);
        $entity->children = [
            new Entity(['name' => 'Child1']),
            new Entity(['name' => 'Child2'])
        ];
        $this->assertCount(2, $entity->children);
        $this->assertInstanceOf(Entity::class, $entity->children[0]);
        $this->assertEquals('Child1', $entity->children[0]->name);
    }

    public function testGetScalarValue()
    {
        $entity = new Entity(['name' => 'Example']);
        $this->assertEquals('Example', $entity->name);
    }

    public function testGetEntityInstance()
    {
        $entity = new Entity(['details' => ['age' => 30]]);
        $this->assertInstanceOf(Entity::class, $entity->details);
        $this->assertEquals(30, $entity->details->age);
    }

    public function testGetArrayOfScalars()
    {
        $entity = new Entity(['tags' => ['php', 'json']]);
        $this->assertEquals(['php', 'json'], $entity->tags);
    }

    public function testGetArrayOfEntities()
    {
        $entity = new Entity([
            'children' => [
                ['name' => 'Child1'],
                ['name' => 'Child2']
            ]
        ]);
        $this->assertCount(2, $entity->children);
        $this->assertInstanceOf(Entity::class, $entity->children[0]);
        $this->assertEquals('Child1', $entity->children[0]->name);
    }

    public function testJsonSerializeWithScalars()
    {
        $entity = new Entity(['name' => 'Example', 'value' => 42]);
        $json = json_encode($entity);
        $expectedJson = '{"name":"Example","value":42}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $json);
    }

    public function testJsonSerializeWithNestedEntities()
    {
        $entity = new Entity(['details' => ['age' => 30, 'city' => 'New York']]);
        $json = json_encode($entity);
        $expectedJson = '{"details":{"age":30,"city":"New York"}}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $json);
    }

    public function testJsonSerializeWithArrays()
    {
        $entity = new Entity([
            'tags' => ['php', 'json'],
            'children' => [
                ['name' => 'Child1'],
                ['name' => 'Child2']
            ]
        ]);
        $json = json_encode($entity);
        $expectedJson = '{"tags":["php","json"],"children":[{"name":"Child1"},{"name":"Child2"}]}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $json);
    }

    public function testToString()
    {
        $entity = new Entity([
            'name' => 'Example',
            'value' => 42,
            'details' => ['age' => 30, 'city' => 'New York'],
            'tags' => ['php', 'json']
        ]);
        $expectedString = <<<JSON
{
    "name": "Example",
    "value": 42,
    "details": {
        "age": 30,
        "city": "New York"
    },
    "tags": [
        "php",
        "json"
    ]
}
JSON;
        $this->assertJsonStringEqualsJsonString($expectedString, (string)$entity);
    }
}