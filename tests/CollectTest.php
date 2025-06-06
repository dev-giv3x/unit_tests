<?php

use PHPUnit\Framework\TestCase;

class CollectTest extends TestCase
{
    public function testCount()
    {
        $collect = new Collect\Collect([13, 17]);
        $this->assertSame(2, $collect->count());
    }

    public function testKeys()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $keys = $collect->keys();

        $this->assertInstanceOf(Collect\Collect::class, $keys);

        $this->assertEquals(['a', 'b', 'c'], $keys->toArray());
    }

    public function testFirst()
    {
        $collect = new Collect\Collect(['x' => 10, 'y' => 20]);
        $first = $collect->first();

        $this->assertEquals(10, $first);
    }

    public function testPop()
    {
        $collect = new Collect\Collect([1, 2, 3]);
        $result = $collect->pop();

        $this->assertInstanceOf(Collect\Collect::class, $result);
        $this->assertEquals([1, 2], $result->toArray());
    }

    public function testSplice()
    {
        $collect = new Collect\Collect([0, 1, 2, 3, 4]);
        $result = $collect->splice(1, 2); 

        $this->assertInstanceOf(Collect\Collect::class, $result);
        $this->assertEquals([0, 3, 4], $result->toArray());
    }
    public function testFirstOnEmptyCollection()
    {
        $collect = new Collect\Collect([]);
        $this->assertNull($collect->first()); 
    }

    public function testPopOnEmptyCollection()
    {
        $collect = new Collect\Collect([]);
        $result = $collect->pop();
        $this->assertInstanceOf(Collect\Collect::class, $result);
        $this->assertEmpty($result->toArray());  
    }

    public function testSpliceWithInvalidIndex()
    {
        $this->expectException(\TypeError::class);  
        $collect = new Collect\Collect([1, 2, 3]);
        $collect->splice('invalid_index', 1);
    }

    public function testSpliceWithNegativeLength()  
    {
        $collect = new Collect\Collect([1, 2, 3, 4]);
        $result = $collect->splice(1, -1);
        $this->assertInstanceOf(Collect\Collect::class, $result);
    }
}